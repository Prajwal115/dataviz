import os
import csv
import json

def extract_headers(filename):
    _, ext = os.path.splitext(filename)
    headers = []

    if ext.lower() == '.csv':
        with open(filename, 'r', encoding='utf-8') as f:
            reader = csv.reader(f)
            headers = next(reader)  # first row as header
    elif ext.lower() == '.json':
        with open(filename, 'r', encoding='utf-8') as f:
            data = json.load(f)
            if isinstance(data, list) and len(data) > 0:
                headers = list(data[0].keys())  # keys from first object
            elif isinstance(data, dict):
                headers = list(data.keys())  # top-level keys (rare format)
    else:
        raise ValueError("Unsupported file type")

    return headers

# Example usage (you can grab filename from haha.txt):
with open("haha.txt", "r") as f:
    path = f.read().strip()

try:
    cols = extract_headers(path)
    print(json.dumps(cols))  # JSON encode the result so PHP can parse
except Exception as e:
    print(json.dumps({"error": str(e)}))