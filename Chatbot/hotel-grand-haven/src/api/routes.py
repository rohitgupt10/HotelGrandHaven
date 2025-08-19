from flask import Blueprint, request, jsonify
from chatbot.classifier import NaiveBayesClassifier
from chatbot.responses import get_response
from utils.preprocess import preprocess_query

api_bp = Blueprint('api', __name__)
classifier = NaiveBayesClassifier()

import os

# Train or load model at startup
model_path = "src/chatbot/model.joblib"
vectorizer_path = "src/chatbot/vectorizer.joblib"
data_path = "src/data/intents_dataset.csv"

if os.path.exists(model_path) and os.path.exists(vectorizer_path):
    classifier.load_model(model_path, vectorizer_path)
else:
    data = classifier.load_data(data_path)
    classifier.train(data)
    classifier.save_model(model_path, vectorizer_path)

@api_bp.route('/query', methods=['POST'])
def handle_query():
    user_query = request.json.get('query')
    if not user_query:
        return jsonify({'error': 'No query provided'}), 400

    preprocessed_query = preprocess_query(user_query)
    intent = classifier.predict(preprocessed_query)
    response = get_response(intent)

    return jsonify({'intent': intent, 'response': response})