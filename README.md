This is the source code for all of the server-side content of the MediScreen project. 
It includes the website source, the Medi-AI source and the Mobile-API source.
MySQL code for the database tables is also included. The project requires that the database be called 'mediscreendb'.
The website and the accompanying MySQL database are run on a XAMPP-powered stack (Appache, MySQL and PHP).


# MediScreen-Web
This is the website of the project and it is intended for participating medical and insurance professionals. Professionals, once registered and logged in, can view a list of patients/clients registered to them, select any one and view their details. If a patient/client has entered sufficient medical data via their mobile app, professionals can get an estimate of that patient's risk of developing certain medical conditions through the Medi-AI service. Professionals may also create reports which are persisted to the database and which may be read by a patient through their mobile app. Insurance professionals can view a medical professional's report for a particular patient, but an insurance professional's report is not visible to the patient's medical professional for privacy reasons.

# Medi-AI
This is the back-end machine learning service, written in Python, which can be called upon to estimate a patient's risk of developing certain medical conditions. The service may be called by a professional from the website or by a patient through their mobile app. There are four medical conditions catered for by Medi-AI in this project. Machine learning models have been compiled for each condition from existing and widely available medical datasets. Predictions are made by feeding the relevant compiled ML model an array of numerical medical data relating to the particular condition. This row of data, or feature set, is read from the database and has been supplied by the patient via their mobile app. The service uses Python's 'Flask' library which sets up a server whose URL endpoints are mapped to execute the Python machine learning functions. The data is posted via HTTP to these endpoints and the functions process the data, carry out the predictions and return the results.

# Mobile-API
This is a collection of PHP scripts which enable the mobile app to communicate with the database and the Medi-AI service. These files are not directly related to the website but need to be on the server none the less. The mobile app makes HTTP POST requests to these scripts via Android's Volley library and the scripts pass the relevant data back (either from the database or the Medi-AI service).
