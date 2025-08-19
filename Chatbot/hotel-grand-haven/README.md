# Hotel Grand Haven Chatbot Project

## Overview
The Hotel Grand Haven project integrates a Naive Bayes Classifier to power an intelligent chatbot designed to enhance guest interaction and streamline the booking experience. The chatbot is capable of understanding user intent from natural language queries and providing real-time responses.

## Features
- **Real-time Query Resolution**: The chatbot classifies incoming user queries into predefined intent categories, such as Room Availability, Booking Requests, Facility Queries, and Cancellation.
- **Instant Responses**: Users can receive immediate answers to their questions, such as room availability, features, and booking processes.
- **Personalized Recommendations**: The chatbot can filter room options based on user specifications, providing tailored suggestions.
- **Continuous Learning**: User interactions are logged for ongoing learning and retraining of the model, improving accuracy over time.

## Project Structure
```
hotel-grand-haven
├── src
│   ├── app.py
│   ├── chatbot
│   │   ├── __init__.py
│   │   ├── classifier.py
│   │   ├── intents.py
│   │   └── responses.py
│   ├── data
│   │   ├── intents_dataset.csv
│   │   └── logs.csv
│   ├── api
│   │   ├── __init__.py
│   │   └── routes.py
│   └── utils
│       └── preprocess.py
├── requirements.txt
└── README.md
```

## Setup Instructions
1. **Clone the Repository**: 
   ```
   git clone <repository-url>
   cd hotel-grand-haven
   ```

2. **Install Dependencies**: 
   Use the following command to install the required libraries:
   ```
   pip install -r requirements.txt
   ```

3. **Run the Application**: 
   Start the Flask application by executing:
   ```
   cd c:\xampp\htdocs\hbwebsite\Chatbot\hotel-grand-haven
   python src/app.py
   ```

## Usage Guidelines
- Access the chatbot through the designated API endpoints defined in `src/api/routes.py`.
- Interact with the chatbot by sending queries related to room availability, booking requests, and other hotel services.

## Future Enhancements
- Expand the dataset for improved intent recognition.
- Implement additional features based on user feedback.
- Optimize the chatbot's performance and response accuracy.

