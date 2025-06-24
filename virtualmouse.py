import cv2
import mediapipe as mp
import time
import autopy
import numpy as np

# Initialize MediaPipe Hands
mp_hands = mp.solutions.hands
hands = mp_hands.Hands(max_num_hands=2, min_detection_confidence=0.5, min_tracking_confidence=0.5)
mp_drawing = mp.solutions.drawing_utils

# Initialize camera and screen size
wCam, hCam = 640, 480
frameR = 100
smoothening = 7

cap = cv2.VideoCapture(0)
cap.set(3, wCam)
cap.set(4, hCam)
wScr, hScr = autopy.screen.size()

# Variables for smoothing the cursor movement
pTime = 0
plocX, plocY = 0, 00
clocX, clocY = 0, 0

while True:
    success, img = cap.read()
    img = cv2.flip(img, 1)

    # Convert the image to RGB
    imgRGB = cv2.cvtColor(img, cv2.COLOR_BGR2RGB)
    
    # Process the image and get hand landmarks
    results = hands.process(imgRGB)

    # Check if hands are detected
    if results.multi_hand_landmarks:
        for hand_landmarks in results.multi_hand_landmarks:
            # Draw hand landmarks
            mp_drawing.draw_landmarks(img, hand_landmarks, mp_hands.HAND_CONNECTIONS)

            # Get coordinates for index (8) and middle (12) fingers
            x1, y1 = int(hand_landmarks.landmark[8].x * wCam), int(hand_landmarks.landmark[8].y * hCam)
            x2, y2 = int(hand_landmarks.landmark[12].x * wCam), int(hand_landmarks.landmark[12].y * hCam)
            
            # Check if both index and middle fingers are up
            fingers_up = [int(hand_landmarks.landmark[i].y < hand_landmarks.landmark[i - 2].y) for i in [8, 12, 16, 20]]

            # Only move the cursor if the index finger is up and middle is down
            if fingers_up[0] == 1 and fingers_up[1] == 0:
                x3 = np.interp(x1, (frameR, wCam - frameR), (0, wScr))
                y3 = np.interp(y1, (frameR, hCam - frameR), (0, hScr))
                clocX = plocX + (x3 - plocX) / smoothening
                clocY = plocY + (y3 - plocY) / smoothening
                autopy.mouse.move(wScr - clocX, clocY)
                plocX, plocY = clocX, clocY

            # Click if distance between index and middle fingers is small
            elif fingers_up[0] == 1 and fingers_up[1] == 1:
                length = np.linalg.norm([x1 - x2, y1 - y2])
                if length < 40:
                    autopy.mouse.click()

    # Display frame rate
    cTime = time.time()
    fps = 1 / (cTime - pTime)
    pTime = cTime
    cv2.putText(img, f'FPS: {int(fps)}', (20, 50), cv2.FONT_HERSHEY_PLAIN, 3, (255, 0, 0), 3)

    # Show image
    cv2.imshow("Image", img)
    if cv2.waitKey(1) & 0xFF == ord('q'):
        break

cap.release()
cv2.destroyAllWindows()
