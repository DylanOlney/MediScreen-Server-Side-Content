# -*- coding: utf-8 -*-
"""
Created on Fri Sep 27 22:59:13 2019

@author: Dylan
"""
import requests
import json

URL = "http://127.0.0.1:5000/predictdiabetes"
values = {"data":[0,147,72,35,0,10.2,0.627,45]}
y = json.dumps(values)
x = requests.post(URL, data = y)

URL = "http://127.0.0.1:5000/diabetesModelAccuracy"
x = requests.post(URL)


