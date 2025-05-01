#!/usr/bin/env python
# train_model.py

import os
import numpy as np
import tensorflow as tf
from tensorflow.keras.preprocessing.image import ImageDataGenerator
from tensorflow.keras.applications import VGG16
from tensorflow.keras.models import Sequential
from tensorflow.keras.layers import Dense, Flatten, Dropout

# Set the dataset path (update these paths as needed)
dataset_path = r"D:\download\MRI_Analysis\MRI_Analysis\Dataset"
train_dir = os.path.join(dataset_path, "Training")
test_dir = os.path.join(dataset_path, "Testing")

img_size = (64, 64)
batch_size = 32

# Create data generators for training and testing.
train_datagen = ImageDataGenerator(
    rescale=1./255,
    rotation_range=20,
    shear_range=0.2,
    zoom_range=0.2,
    horizontal_flip=True
)
test_datagen = ImageDataGenerator(rescale=1./255)

train_generator = train_datagen.flow_from_directory(
    train_dir,
    target_size=img_size,
    batch_size=batch_size,
    class_mode='categorical'
)
test_generator = test_datagen.flow_from_directory(
    test_dir,
    target_size=img_size,
    batch_size=batch_size,
    class_mode='categorical'
)

# Build the model using transfer learning with VGG16 as base.
base_model = VGG16(input_shape=(64, 64, 3), weights='imagenet', include_top=False)
base_model.trainable = False  # Freeze the base model layers.

model = Sequential([
    base_model,
    Flatten(),
    Dense(128, activation='relu'),
    Dropout(0.5),
    Dense(4, activation='softmax')
])
model.compile(optimizer='adam', loss='categorical_crossentropy', metrics=['accuracy'])

# Train the model.
history = model.fit(train_generator, epochs=15, validation_data=test_generator)
loss, accuracy = model.evaluate(test_generator)
print(f"Test Accuracy: {accuracy * 100:.2f}%")

# Save the trained model.
model_save_path = r"C:\xampp\htdocs\dashboard\segpAI\app\ai_model\my_trained_model.h5"
model.save(model_save_path)
print(f"Model saved at {model_save_path}")
