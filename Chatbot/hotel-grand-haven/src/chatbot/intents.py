from typing import List, Dict
import pandas as pd

class Intents:
    def __init__(self, csv_file: str):
        self.intents = self.load_intents(csv_file)

    def load_intents(self, csv_file: str) -> List[Dict]:
        data = pd.read_csv(csv_file)
        intents = []
        for _, row in data.iterrows():
            intents.append({
                'intent': row['intent'],
                'patterns': row['patterns'].split('|'),
                'responses': row['responses'].split('|')
            })
        return intents

    def get_intents(self) -> List[Dict]:
        return self.intents

    def get_intent_by_name(self, intent_name: str) -> Dict:
        for intent in self.intents:
            if intent['intent'] == intent_name:
                return intent
        return None