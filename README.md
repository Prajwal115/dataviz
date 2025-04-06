# 📊 DataViz

**DataViz** is a one-stop data visualization and analysis platform where users can upload structured datasets (CSV/JSON) and interact with intelligent tools — including predictive modeling, statistical analysis, and graph plotting — all wrapped inside an intuitive thread-based interface.

---

## 🚀 Features

- 📂 **File Upload**: Upload datasets in CSV/JSON format.
- 🧠 **Predict**: Apply machine learning models (regression/classification) to predict values based on selected fields.
- 📈 **Charts**: Generate charts using Python (matplotlib, seaborn) and return them as downloadable images.
- 📊 **Analyse**: Run basic statistical operations like mean, median, mode, standard deviation, null value checks, etc.
- 💬 **Thread-Based Interface**: Every dataset upload creates a "thread" for continued interaction with the dataset.
- 🔐 **Login/Register System**: User authentication to store and track individual threads and uploaded files.

---

## 🛠 Tech Stack

- **Frontend**: HTML, CSS, Vanilla JavaScript
- **Backend**: PHP
- **Data Processing**: Python (NumPy, pandas, matplotlib, seaborn, scikit-learn)
- **Storage**: Local server directories (recommend/ directory per user session)

---

## 🧠 Architecture Overview

1. User logs in or registers.
2. Upload a dataset → creates a new thread.
3. The uploaded file is sent to the server and stored.
4. PHP communicates with Python scripts to process the data based on user commands.
5. The response is returned to PHP and displayed in the chat-style interface.

![Architecture Flowchart](res/prajwal/project%20archievetures.png)

---

## 📂 Folder Structure

```plaintext
/
├── index.html
├── login.php
├── register.php
├── dashboard/
│   ├── dashboard.html
│   └── script.js
├── uploads/
├── recommend/
├── python/
│   ├── predict.py
│   ├── analyze.py
│   ├── chart.py
├── styles/
│   └── main.css

```

**📈 Chart Types Supported**
	•	Line Chart
	•	Bar Chart
	•	Histogram
	•	Pie Chart
	•	Scatter Plot
	•	Heatmap

Charts are generated using matplotlib and saved as images, which are then displayed in the browser.

It mainly utilises PHP's **exec() function** and text file handling to bind PHP and Python together. Little to no information exchanged in the latter.


**🔍 Sample Use Cases**
	•	Predict housing prices based on area and number of bedrooms.
	•	Analyze user engagement trends in marketing datasets.
	•	Visualize sales performance using bar and pie charts.
	•	Detect missing values and understand statistical properties of uploaded datasets.


**✨ Future Improvements/ Things to Do**
	•	Add multi-thread support for advanced conversation history.
	•	Integrate export-to-Excel or PDF features.
 	•	Link ML with PHP and Python (**finally💀**)
	•	Enhance UI with dark mode and responsive design.
	•	Deploy on a remote server for public access (**Gotta use AWS carefully)💀**
 	•	Fix a lot of UI bugs.

 **Thanks a lot to the Web, Google Collab, W3Schools, ChatGPT, Gemini and the internet.**

 
 **signing off for now. I will be back to finish this project. _very soon_ This README will also later expand to guide on how to run this locally. Good.. night** 💀🙏🏻
 


