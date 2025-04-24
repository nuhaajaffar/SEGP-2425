#!/usr/bin/env python
# MRI_Analysis.py

import sys
import os
import numpy as np
import tensorflow as tf
import json
from tensorflow.keras.preprocessing.image import load_img, img_to_array
from fpdf import FPDF
from datetime import datetime

# Optionally, set environment variables if needed
# os.environ['TF_ENABLE_ONEDNN_OPTS'] = '0'

# Define image size and model path.
IMG_SIZE = (64, 64)
# Update this path to point to your saved model file.
MODEL_PATH = r"C:\xampp\htdocs\dashboard\segpAI\app\ai_model\my_trained_model.h5"

# Load the model and perform a warm-up run.
try:
    model = tf.keras.models.load_model(MODEL_PATH)
except Exception as e:
    print(f"Error loading model from {MODEL_PATH}: {e}")
    sys.exit(1)

# Warm up the model with a dummy input.
dummy_input = np.zeros((1, 64, 64, 3))
_ = model.predict(dummy_input)

# Define class labels as used during training.
CLASS_LABELS = ["glioma", "meningioma", "pituitary", "notumor"]

def generate_tumor_analysis(prediction):
    analysis_text = {
        "meningioma": (
            "Meningiomas are typically slow-growing tumors that develop in the meninges, "
            "the protective layers surrounding the brain and spinal cord. While often benign, "
            "they can cause neurological symptoms depending on their size and location. "
            "Further imaging and a specialist consultation are recommended."
        ),
        "glioma": (
            "Gliomas are tumors that arise from glial cells in the brain. Their severity can vary, "
            "ranging from low-grade (slow-growing) to high-grade (aggressive). Additional tests, such as "
            "biopsy or advanced imaging, may be necessary to determine the best course of action."
        ),
        "pituitary": (
            "Pituitary tumors develop in the pituitary gland, which regulates hormones. Most are benign, "
            "but they can affect hormone production and cause symptoms like vision problems or headaches. "
            "Endocrinological evaluation is recommended."
        ),
        "notumor": (
            "No abnormal tumor growth was detected in this scan. However, if the patient is experiencing "
            "neurological symptoms, further medical evaluation may be necessary."
        )
    }
    return analysis_text.get(prediction, "No specific analysis available for this prediction.")

def generate_report(prediction, confidence, img_path, report_filepath, patient_info):
    scan_date = datetime.now().strftime("%Y-%m-%d")
    pdf = FPDF()
    pdf.set_auto_page_break(auto=True, margin=15)
    pdf.add_page()

    # Add logo (if available)
    logo_path = os.path.join(os.path.dirname(__file__), 'logo.png')
    if os.path.exists(logo_path):
        pdf.image(logo_path, x=10, y=8, w=30)  # Adjust x/y/w as needed
        pdf.ln(20)  # Add spacing below logo
    else:
        print("Logo not found at:", logo_path)

    # Title
    pdf.set_font("Arial", "B", 16)
    pdf.cell(200, 10, "MRI Brain Tumor Analysis Report", ln=True, align="C")
    pdf.ln(10)
    
    # ✅ Patient Info
    pdf.set_font("Arial", "B", 12)
    pdf.cell(0, 10, "Patient Information", ln=True)
    pdf.set_font("Arial", "", 12)
    pdf.cell(0, 10, f"Name: {patient_info.get('name', 'N/A')}", ln=True)
    pdf.cell(0, 10, f"DOB: {patient_info.get('dob', 'N/A')}", ln=True)
    pdf.cell(0, 10, f"Sex: {patient_info.get('sex', 'N/A')}", ln=True)
    pdf.cell(0, 10, f"Assigned Doctor: {patient_info.get('assigned_doctor', 'N/A')}", ln=True)
    pdf.cell(0, 10, f"Assigned Radiologist: {patient_info.get('assigned_radiologist', 'N/A')}", ln=True)
    pdf.cell(0, 10, f"Assigned Radiographer: {patient_info.get('assigned_radiographer', 'N/A')}", ln=True)
    pdf.ln(10)

    # Add the scan image if it exists
    if os.path.exists(img_path):
        pdf.image(img_path, x=40, w=130)
        pdf.ln(80)
    else:
        print(f"Warning: Image file not found at {img_path}")

    # Report details
    pdf.set_font("Arial", "", 12)
    pdf.cell(200, 10, f"Scan Date: {scan_date}", ln=True)
    pdf.ln(5)
    
    pdf.set_font("Arial", "B", 12)
    pdf.cell(200, 10, "Prediction Result:", ln=True)
    pdf.set_font("Arial", "", 12)
    pdf.cell(200, 10, f"Detected Tumor Type: {prediction.upper()}", ln=True)
    pdf.cell(200, 10, f"Confidence Level: {confidence:.2f}%", ln=True)
    pdf.ln(10)

    pdf.set_font("Arial", "B", 12)
    pdf.cell(200, 10, "AI Analysis:", ln=True)
    pdf.set_font("Arial", "", 12)
    pdf.multi_cell(0, 10, generate_tumor_analysis(prediction))
    pdf.ln(10)

    pdf.set_font("Arial", "B", 10)
    pdf.cell(200, 0, "Disclaimer:", ln=True)
    pdf.set_font("Arial", "", 10)
    pdf.multi_cell(0, 10, "This is an AI-generated preliminary analysis and should not be considered a final diagnosis.")

    # Ensure the output directory exists.
    output_dir = os.path.dirname(report_filepath)
    if not os.path.exists(output_dir):
        os.makedirs(output_dir, exist_ok=True)

    # Save the PDF report.
    pdf.output(report_filepath)
    return report_filepath

def process_image(image_path, report_output_path, patient_info_path):
    if not os.path.exists(image_path):
        print("Error: Image file not found.")
        sys.exit(1)

    if not os.path.exists(patient_info_path):
        print("Error: Patient info not found.")
        return

    with open(patient_info_path, 'r') as f:
        patient_info = json.load(f)

    # Load and preprocess the image.
    img = load_img(image_path, target_size=IMG_SIZE)
    img_array = img_to_array(img) / 255.0
    img_array = np.expand_dims(img_array, axis=0)

    # Run prediction.
    prediction = model.predict(img_array)
    class_index = np.argmax(prediction)
    detected_tumor = CLASS_LABELS[class_index]
    confidence_level = prediction[0][class_index] * 100

    # Generate and save the report.
    report_path = generate_report(detected_tumor, confidence_level, image_path, report_output_path, patient_info)
    print(f"Report generated at: {report_path}")

if __name__ == '__main__':
    # Expect two command-line arguments: the input image path and the desired report output path.
    if len(sys.argv) != 4:
        print("Usage: python MRI_Analysis.py <image_path> <report_output_path> <patient_info_path>")
        sys.exit(1)
    
    image_path = sys.argv[1]
    report_output_path = sys.argv[2]
    patient_info_path = sys.argv[3]

    process_image(image_path, report_output_path, patient_info_path)
