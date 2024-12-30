# client-service/app.py
from flask import Flask, request, jsonify
import sqlite3

app = Flask(__name__)

# Initialize SQLite
conn = sqlite3.connect('clients.db', check_same_thread=False)
cursor = conn.cursor()
cursor.execute("CREATE TABLE IF NOT EXISTS clients (id INTEGER PRIMARY KEY, name TEXT, email TEXT)")
conn.commit()

@app.route('/clients', methods=['GET'])
def get_clients():
    cursor.execute("SELECT * FROM clients")
    clients = cursor.fetchall()
    return jsonify(clients)

@app.route('/clients', methods=['POST'])
def add_client():
    data = request.json
    cursor.execute("INSERT INTO clients (name, email) VALUES (?, ?)", (data['name'], data['email']))
    conn.commit()
    return jsonify({'id': cursor.lastrowid, 'name': data['name'], 'email': data['email']}), 201

if __name__ == '__main__':
    app.run(port=3001)
