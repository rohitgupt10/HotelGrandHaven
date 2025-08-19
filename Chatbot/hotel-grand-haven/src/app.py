from flask import Flask, request, jsonify
from flask_cors import CORS
from chatbot.classifier import NaiveBayesClassifier
from api.routes import api_bp


app = Flask(__name__)
CORS(app)


# Initialize the Naive Bayes Classifier
classifier = NaiveBayesClassifier()

# Register the API blueprint
app.register_blueprint(api_bp)

@app.route('/')
def home():
    return "Welcome to the Hotel Grand Haven Chatbot!"

if __name__ == '__main__':
    app.run(debug=True)