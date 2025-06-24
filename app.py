from flask import Flask
import subprocess

app = Flask(__name__)

@app.route('/run-script1', methods=['POST'])
def run_script1():
    subprocess.Popen(["python", "test.py"])
    return '', 204

@app.route('/run-script2', methods=['POST'])
def run_script2():
    subprocess.Popen(["python", "stop.py"])
    return '', 204

if __name__ == '__main__':
    app.run(debug=True)
