from sklearn.naive_bayes import MultinomialNB
from sklearn.feature_extraction.text import CountVectorizer
import pandas as pd
import joblib

class NaiveBayesClassifier:
    def __init__(self):
        self.vectorizer = CountVectorizer()
        self.model = MultinomialNB()
        self.intents = None

    def load_data(self, filepath):
        data = pd.read_csv(filepath)
        self.intents = data['intent'].unique()
        return data

    def train(self, data):
        X = self.vectorizer.fit_transform(data['query'])
        y = data['intent']
        self.model.fit(X, y)

    def predict(self, query):
        query_vector = self.vectorizer.transform([query])
        intent = self.model.predict(query_vector)
        return intent[0]

    def save_model(self, model_path, vectorizer_path):
        joblib.dump(self.model, model_path)
        joblib.dump(self.vectorizer, vectorizer_path)

    def load_model(self, model_path, vectorizer_path):
        self.model = joblib.load(model_path)
        self.vectorizer = joblib.load(vectorizer_path)