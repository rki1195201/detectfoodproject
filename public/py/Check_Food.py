import csv
from PIL import Image
import numpy as np
import time
import pickle
import sys
from joblib import dump, load

testX = []
testY = []

# Input one image:
# testImg = Image.open('FoodNonFoodDataset/Testing/testImg3.jpg')
testImg = Image.open(sys.argv[1])
testImg = testImg.resize((50, 50), Image.BICUBIC)
testImg = np.array(testImg)
testX.append(testImg.flatten())
testX = np.array(testX)

# Load SVM Model:
t = time.time()
clf2 = load('py/save/Food_NonFood_Model.pickle')
pre = clf2.predict(testX)
score = clf2.decision_function(testX)
acc = float((pre == testY).sum())/len(testX)
print(pre)