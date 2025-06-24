import cv2
from cvzone.HandTrackingModule import HandDetector
from time import sleep
import cvzone
from pynput.keyboard import Controller

# Webcam setup
cap = cv2.VideoCapture(0)
cap.set(3, 1280)  # Width
cap.set(4, 720)   # Height

# Hand detector
detector = HandDetector(detectionCon=0.8, maxHands=1)

# Keyboard layout
keys = [["Backspace"],
        ["Q", "W", "E", "R", "T", "Y", "U", "I", "O", "P"],
        ["A", "S", "D", "F", "G", "H", "J", "K", "L", ";"],
        ["Z", "X", "C", "V", "B", "N", "M", ",", ".", "/"],
        ["Spacebar"]]

finalText = ""
keyboard = Controller()

# Button class
class Button:
    def __init__(self, pos, text, size=None):
        self.pos = pos
        self.text = text
        if size is None:
            self.size = [max(60, len(self.text) * 25), 60]
        else:
            self.size = size
        self.active = False  # For debounce control

# Draw all buttons
def drawAll(img, buttonList):
    for button in buttonList:
        x, y = button.pos
        w, h = button.size
        color1 = (0, 255, 0)
        cvzone.cornerRect(img, (x, y, w, h), 20, rt=0)
        cv2.rectangle(img, (x, y), (x + w, y + h), color1, -1)

        # Center the text
        text_size = cv2.getTextSize(button.text, cv2.FONT_HERSHEY_PLAIN, 2.5, 3)[0]
        text_x = x + (w - text_size[0]) // 2
        text_y = y + (h + text_size[1]) // 2 - 5
        cv2.putText(img, button.text, (text_x, text_y),
                    cv2.FONT_HERSHEY_PLAIN, 2.5, (255, 255, 255), 3)
    return img

# Create button objects
buttonList = []
keyboard_width = 1000
start_x = (1280 - keyboard_width) // 2

for i in range(len(keys)):
    for j, key in enumerate(keys[i]):
        if key == "Backspace":
            buttonList.append(Button([start_x + 350, 100], key, [300, 60]))
        elif key == "Spacebar":
            buttonList.append(Button([start_x + 300, 550], key, [400, 60]))  # ⬅️ Moved spacebar up
        else:
            x = start_x + j * 90
            y = 100 + (i + 1) * 80
            buttonList.append(Button([x, y], key))
# Main loop
while True:
    success, img = cap.read()
    img = cv2.flip(img, 1)  # Mirror the image
    hands, img = detector.findHands(img)

    img = drawAll(img, buttonList)

    if hands:
        lmList = hands[0]['lmList']

        for button in buttonList:
            x, y = button.pos
            w, h = button.size

            if x < lmList[12][0] < x + w and y < lmList[12][1] < y + h:
                # Highlight on hover
                cv2.rectangle(img, (x - 5, y - 5), (x + w + 5, y + h + 5),
                              (0, 100, 0), cv2.FILLED)
                text_size = cv2.getTextSize(button.text, cv2.FONT_HERSHEY_PLAIN, 2.5, 3)[0]
                text_x = x + (w - text_size[0]) // 2
                text_y = y + (h + text_size[1]) // 2 - 5
                cv2.putText(img, button.text, (text_x, text_y),
                            cv2.FONT_HERSHEY_PLAIN, 2.5, (255, 255, 255), 3)

                # Check for click gesture
                x1, y1, _ = lmList[12]
                x2, y2, _ = lmList[8]
                length, _, _ = detector.findDistance((x1, y1), (x2, y2), img)

                if length < 30:
                    if not button.active:
                        if button.text == "Backspace":
                            finalText = finalText[:-1]
                        elif button.text == "Spacebar":
                            finalText += " "
                        else:
                            finalText += button.text
                        button.active = True
                        sleep(0.2)
                elif length > 40:
                    button.active = False

    # Display text slightly higher than bottom
    display_width = min(max(700, len(finalText) * 25), 1180)
    display_x = (1280 - display_width) // 2
    display_y = 630  # 👈 moved up from 680 to 620

    cv2.rectangle(img, (display_x, display_y), (display_x + display_width, display_y + 60), (175, 0, 175), cv2.FILLED)
    cv2.putText(img, finalText, (display_x + 20, display_y + 45),
                cv2.FONT_HERSHEY_PLAIN, 2.8, (255, 255, 255), 4)

    cv2.imshow("Virtual Keyboard", img)

    # 🛑 Exit if 'q' is pressed
    if cv2.waitKey(1) & 0xFF == ord('q'):
        break

# Release resources
cap.release()
cv2.destroyAllWindows()
