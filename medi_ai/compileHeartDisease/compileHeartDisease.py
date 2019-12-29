
from numpy import loadtxt
from keras.models import Sequential
from keras.layers import Dense
#from keras.optimizers import SGD 

# load dataset
dataset = loadtxt("heartDisease.csv", delimiter=",")

# split into input (X) and output (Y) variables
X = dataset[:,0:13]
Y = dataset[:,13]

# define model
model = Sequential()
model.add(Dense(12, input_dim=13, activation='relu'))
model.add(Dense(8, activation='relu'))
model.add(Dense(1, activation='sigmoid'))

# compile model
print("Compiling model...")
#opt = SGD(lr=1e-2, momentum=0.9, decay=1e-2/150)
model.compile(loss='binary_crossentropy', optimizer='adam', metrics=['accuracy'])

# Fit the model
print("Fitting model...")
model.fit(X, Y, epochs=150, batch_size=10, verbose=1)

# evaluate the model
scores = model.evaluate(X, Y, verbose=0)
print("%s: %.2f%%" % (model.metrics_names[1], scores[1]*100))

# save model and architecture to single file
model.save("../models/heartDisease.h5")

input("Saved model to disk. Press any key to exit....")