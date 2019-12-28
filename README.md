# MediScreen-Website
This is the website for the project which is intended for participating medical and insurance professionals. 
Professionals, once registered and logged in, can view a list of their patients/clients, select any and view their details. 
If a patient/client has entered sufficient medical data via their mobile app, professionals can also get an estimate of that patient's risk of developing certain medical conditions through the Medi-AI service. Professionals may also create reports which are stored to the database. Insurance professionals can view a medical professioanal's report for a particular patient, but an insurance professional's report is not visible to the patient's medical professional.

# Medi-AI
This is a back-end machine learning service, written in Python, that can be called upon to estimate a patient's risk of developing certain medical conditions. The service can be called by a professional from the website or by a patient through their mobile app. There are four medical conditions catered for by Medi-AI in this project. Machine learning models have been compiled for each condition and predictions are made by feeding a model with a row of numerical medical data relating to the particular condition. This data, or feature set, is read from the database and has been supplied by the patient via their mobile app.
