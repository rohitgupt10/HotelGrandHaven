def preprocess_query(query):
    # Lowercase and remove non-alphanumeric chars
    import re
    query = query.lower()
    query = re.sub(r'[^a-z0-9\s]', '', query)
    return query
    
    # Tokenization: Split the query into words
    tokens = query.split()
    
    # Remove punctuation and non-alphanumeric characters
    tokens = [word for word in tokens if word.isalnum()]
    
    return tokens

def normalize_query(tokens):
    # Example normalization: stemming or lemmatization can be added here
    # For simplicity, we will just return the tokens as is
    return tokens

def preprocess_user_query(query):
    tokens = preprocess_query(query)
    normalized_tokens = normalize_query(tokens)
    return normalized_tokens