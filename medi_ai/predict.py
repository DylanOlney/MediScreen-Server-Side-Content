# -*- coding: utf-8 -*-
"""
Created on Sat Sep 28 00:31:57 2019

@author: Dylan

This script sets up the AI Flask server.
"""

import numpy as np
import json
from keras.models import load_model
from flask import request
from flask import Flask
app = Flask(__name__)


# When the service starts, our model(s) are loaded into global variables so that they
# will be available on request.
def load_models():
    global diabetes_model
    global heartdisease_model
    global breast_cancer_model
    global prostate_model
    diabetes_model = load_model('models/diabetes.h5')
    heartdisease_model = load_model('models/heartDisease.h5')
    breast_cancer_model = load_model('models/breastcancer.h5')
    prostate_model = load_model('models/prostate.h5')
    print("Models loaded!")

print ("Loading models....")


# See above..
load_models()


# A sinmple test function to see if our service is running and visible.
@app.route('/test')
def test():
    return 'Flask is running!'

#======================================================================================================================================================

# Diabetes functions.

# The following fuction gets called when our apps POST some json to http://localhost:5000//predictdiabetes
# The POSTed data will be recieved in json format as follows: {"data" : <array>}
# On successful prediction, another json object is returned containing the result.

# Prediction function.
@app.route("/predictdiabetes", methods = ["POST"])
def predictdiabetes():
    data = request.get_json(force = True)   # The data will be recieved in json format as follows: {"data" : <array>}
    print(data["data"])                     # Show the array data in the flask console.
    X = np.array([data["data"]])            # Create a numpy array from the array.
    prediction = diabetes_model.predict_proba(X).tolist()   # make a prediction on our data against ourpre-compiled diabetes model 
    probability = round(prediction[0][0],4) # The result was a probability. This line rounds it to 4 decimal places
    binary = round(prediction[0][0])        # This is the binary result, if needed. Rounds the above result to either 0 or 1.
    response = {'probability':probability,"binary":binary} # Create and return our result in json format.
    x = json.dumps(response)
    print(x)
    return x


# The following fuction gets called when our apps make a post request POST to http://localhost:5000//diabetesModelAccuracy
# Its is much the same as the above function only that it doesn't need any json data posted to it.
# It's purpose is to return the model accuracy as a percentage.

# Model accuracy report function.
@app.route("/diabetesModelAccuracy", methods = ["POST"])
def diabetesModelAccuracy():
    dataset = np.loadtxt("compileDiabetes/diabetes.csv", delimiter=",")
    X = dataset[:,0:8] # [All rows, columns 0 through 7]
    Y = dataset[:,8]   # [All rows, just column 8]
    scores = diabetes_model.evaluate(X, Y, verbose=0)
    result =  {'accuracy': round(scores[1]*100,2)}
    x = json.dumps(result)
    print(x)
    return x

# This function allows administrator of website create a new dataset from all existing diabetes data in database.
@app.route("/newDiabetesDataset", methods = ["POST"])
def newDiabetesDataset():
    data = request.get_json(force = True)
    print(data)
    csv = open("exportedDatasets/diabetes/diabetes.csv","w+")
    for row in data:
        q =str(row).replace('[','') 
        q = q.replace(']','')
        csv.write(q + "\n")
    csv.close
    result = dict()
    result['result'] = "OK"
    x = json.dumps(result)
    return x


# This function allows administrator of website append an existing dataset with all existing diabetes data in database.
@app.route("/appendDiabetesDataset", methods = ["POST"])
def appendDiabetesDataset():
    data = request.get_json(force = True)
    print(data)
    csv = open("exportedDatasets/diabetes/diabetes.csv","a+")
    for row in data:
        q =str(row).replace('[','') 
        q = q.replace(']','')
        csv.write(q + "\n")
    csv.close
    result = dict()
    result['result'] = "OK"
    x = json.dumps(result)
    return x
##=====================================================================================================================================



#==========================================================================================================================================
# Heart Disease functions.

# Prediction function.
@app.route("/predictHeartDisease", methods = ["POST"])
def predictHeartDisease():
    data = request.get_json(force = True)   # The data will be recieved in json format as follows: {"data" : <array>}
    print(data["data"])                     # Show the array data in the flask console.
    X = np.array([data["data"]])            # Create a numpy array from the array.
    prediction = heartdisease_model.predict_proba(X).tolist()   # make a prediction on our data against ourpre-compiled diabetes model 
    probability = round(prediction[0][0],4) # The result was a probability. This line rounds it to 4 decimal places
    binary = round(prediction[0][0])        # This is the binary result, if needed. Rounds the above result to either 0 or 1.
    response = {'probability':probability,"binary":binary} # Create and return our result in json format.
    x = json.dumps(response)
    print(x)
    return x



# Model accuracy report function.
@app.route("/heartDiseaseModelAccuracy", methods = ["POST"])
def heartDiseaseModelAccuracy():
    dataset = np.loadtxt("compileHeartDisease/heartDisease.csv", delimiter=",")
    X = dataset[:,0:13]
    Y = dataset[:,13]
    scores = heartdisease_model.evaluate(X, Y, verbose=0)
    result =  {'accuracy': round(scores[1]*100,2)}
    x = json.dumps(result)
    print(x)
    return x



# This function allows administrator of website create a new dataset from all existing heart disease data in database.
@app.route("/newHeartDataset", methods = ["POST"])
def newHeartDataset():
    data = request.get_json(force = True)
    print(data)
    csv = open("exportedDatasets/heartDisease/heartDisease.csv","w+")
    for row in data:
        q =str(row).replace('[','') 
        q = q.replace(']','')
        csv.write(q + "\n")
    csv.close
    result = dict()
    result['result'] = "OK"
    x = json.dumps(result)
    return x


# This function allows administrator of website append an existing dataset with all existing heart disease data in database.
@app.route("/appendHeartDataset", methods = ["POST"])
def appendHeartDataset():
    data = request.get_json(force = True)
    print(data)
    csv = open("exportedDatasets/heartDisease/heartDisease.csv","a+")
    for row in data:
        q =str(row).replace('[','') 
        q = q.replace(']','')
        csv.write(q + "\n")
    csv.close
    result = dict()
    result['result'] = "OK"
    x = json.dumps(result)
    return x

##====================================================================================================================================

# Breast cancer functions.

# Prediction function.
@app.route("/predictBreastCancer", methods = ["POST"])
def predictBreastCancer():
    data = request.get_json(force = True)   # The data will be recieved in json format as follows: {"data" : <array>}
    print(data["data"])                     # Show the array data in the flask console.
    X = np.array([data["data"]])            # Create a numpy array from the array.
    prediction = breast_cancer_model.predict_proba(X).tolist()   # make a prediction on our data against ourpre-compiled diabetes model 
    probability = round(prediction[0][0],4) # The result was a probability. This line rounds it to 4 decimal places
    binary = round(prediction[0][0])        # This is the binary result, if needed. Rounds the above result to either 0 or 1.
    response = {'probability':probability,"binary":binary} # Create and return our result in json format.
    x = json.dumps(response)
    print(x)
    return x

# Model accuracy report function.
@app.route("/breastCancerModelAccuracy", methods = ["POST"])
def breastCancerModelAccuracy():
    dataset = np.loadtxt("compileBreastCancer/breastCancer.csv", delimiter=",")
    X = dataset[:,0:9] # [All rows, columns 0 through 8].
    Y = dataset[:,9]   # [All rows, just column 9].
    scores = breast_cancer_model.evaluate(X, Y, verbose=0)
    result =  {'accuracy': round(scores[1]*100,2)}
    x = json.dumps(result)
    print(x)
    return x


# This function allows administrator of website create a new dataset from all existing breast cancer data in database.
@app.route("/newBreastDataset", methods = ["POST"])
def newBreastDataset():
    data = request.get_json(force = True)
    print(data)
    csv = open("exportedDatasets/breastCancer/breastCancer.csv","w+")
    for row in data:
        q =str(row).replace('[','') 
        q = q.replace(']','')
        csv.write(q + "\n")
    csv.close
    result = dict()
    result['result'] = "OK"
    x = json.dumps(result)
    return x


# This function allows administrator of website append an existing dataset with all existing breast cancer data in database.
@app.route("/appendBreastDataset", methods = ["POST"])
def appendBreastDataset():
    data = request.get_json(force = True)
    print(data)
    csv = open("exportedDatasets/breastCancer/breastCancer.csv","a+")
    for row in data:
        q =str(row).replace('[','') 
        q = q.replace(']','')
        csv.write(q + "\n")
    csv.close
    result = dict()
    result['result'] = "OK"
    x = json.dumps(result)
    return x


#===============================================================================================================================================





# Prostate functions

# Prediction function.
@app.route("/predictProstateCancer", methods = ["POST"])
def predictProstate():
    data = request.get_json(force = True)   # The data will be recieved in json format as follows: {"data" : <array>}
    print(data["data"])                     # Show the array data in the flask console.
    X = np.array([data["data"]])            # Create a numpy array from the array.
    prediction = prostate_model.predict_proba(X).tolist()   # make a prediction on our data against ourpre-compiled diabetes model 
    probability = round(prediction[0][0],4) # The result was a probability. This line rounds it to 4 decimal places
    binary = round(prediction[0][0])        # This is the binary result, if needed. Rounds the above result to either 0 or 1.
    response = {'probability':probability,"binary":binary} # Create and return our result in json format.
    x = json.dumps(response)
    print(x)
    return x


# The following fuction gets called when our apps make a post request POST to http://localhost:5000//diabetesModelAccuracy
# Its is much the same as the above function only that it doesn't need any json data posted to it.
# It's purpose is to return the model accuracy as a percentage.

# Model accuracy report function.
@app.route("/prostateModelAccuracy", methods = ["POST"])
def prostateModelAccuracy():
    dataset = np.loadtxt("compileProstate/prostate.csv", delimiter=",")
    X = dataset[:,0:8] # [All rows, columns 0 through 7]
    Y = dataset[:,8]   # [All rows, just column 8]
    scores = prostate_model.evaluate(X, Y, verbose=0)
    result =  {'accuracy': round(scores[1]*100,2)}
    x = json.dumps(result)
    print(x)
    return x



# This function allows administrator of website create a new dataset from all existing breast cancer data in database.
@app.route("/newProstateDataset", methods = ["POST"])
def newProstateDataset():
    data = request.get_json(force = True)
    print(data)
    csv = open("exportedDatasets/prostateCancer/prostate.csv","w+")
    for row in data:
        q =str(row).replace('[','') 
        q = q.replace(']','')
        csv.write(q + "\n")
    csv.close
    result = dict()
    result['result'] = "OK"
    x = json.dumps(result)
    return x


# This function allows administrator of website append an existing dataset with all existing breast cancer data in database.
@app.route("/appendProstateDataset", methods = ["POST"])
def appendProstateDataset():
    data = request.get_json(force = True)
    print(data)
    csv = open("exportedDatasets/prostateCancer/prostate.csv","a+")
    for row in data:
        q =str(row).replace('[','') 
        q = q.replace(']','')
        csv.write(q + "\n")
    csv.close
    result = dict()
    result['result'] = "OK"
    x = json.dumps(result)
    return x
