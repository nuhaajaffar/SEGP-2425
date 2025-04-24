#!/usr/bin/env python
import mysql.connector
from mysql.connector import Error
from fpdf import FPDF
from datetime import datetime, date

# === Fetch patient details from DB ===
def fetch_patient_details():
    try:
        connection = mysql.connector.connect(
            host='localhost',
            port=3306,
            database='segpai',
            user='root',
            password=''
        )
        if connection.is_connected():
            cursor = connection.cursor(dictionary=True)
            query = """
            SELECT hu.id, hu.name, hu.sex, hu.dob,
                   d.name AS assigned_doctor,
                   r.name AS assigned_radiologist,
                   g.name AS assigned_radiographer
            FROM hospital_users hu
            LEFT JOIN hospital_users d ON hu.assigned_doctor_id = d.id
            LEFT JOIN hospital_users r ON hu.assigned_radiologist_id = r.id
            LEFT JOIN hospital_users g ON hu.assigned_radiographer_id = g.id
            WHERE hu.role = 'patient'
            """
            cursor.execute(query)
            return cursor.fetchall()
    except Error as e:
        print("Database Error:", e)
        return []
    finally:
        if connection.is_connected():
            cursor.close()
            connection.close()

# === Utility: Calculate age from DOB ===
def calculate_age(dob):
    if not dob:
        return 'N/A'
    dob_date = dob if isinstance(dob, date) else datetime.strptime(str(dob), "%Y-%m-%d").date()
    today = date.today()
    return today.year - dob_date.year - ((today.month, today.day) < (dob_date.month, dob_date.day))

# === PDF Class with Header/Footer/Styling ===
class PDF(FPDF):
    def header(self):
        # Logo
        self.image('logo.png', 10, 8, 25)  # Adjust path/size as needed
        self.set_font('Arial', 'B', 14)
        self.cell(0, 10, 'SEGPAI - Patient Details Report', ln=1, align='C')
        self.set_font('Arial', '', 10)
        self.cell(0, 10, f'Generated on: {datetime.now().strftime("%Y-%m-%d %H:%M:%S")}', ln=1, align='C')
        self.ln(5)

    def footer(self):
        self.set_y(-15)
        self.set_font('Arial', 'I', 8)
        self.cell(0, 10, f'Page {self.page_no()}', 0, 0, 'C')

# === PDF Generator ===
def generate_pdf(patients, output_path):
    pdf = PDF()
    pdf.add_page()
    pdf.set_font('Arial', 'B', 11)

    headers = ['ID', 'Name', 'Sex', 'DOB', 'Age', 'Doctor', 'Radiologist', 'Radiographer']
    col_widths = [12, 30, 12, 22, 12, 30, 35, 35]

    # Header row
    for i, header in enumerate(headers):
        pdf.cell(col_widths[i], 10, header, 1, 0, 'C')
    pdf.ln()

    pdf.set_font('Arial', '', 10)
    fill = False  # For alternating row colors

    for patient in patients:
        age = calculate_age(patient['dob'])

        row = [
            str(patient['id']),
            patient['name'],
            patient['sex'] if patient['sex'] else 'N/A',
            str(patient['dob']) if patient['dob'] else 'N/A',
            str(age),
            str(patient.get('assigned_doctor', '')).strip() or 'N/A',
            str(patient.get('assigned_radiologist', '')).strip() or 'N/A',
            str(patient.get('assigned_radiographer', '')).strip() or 'N/A'
        ]

        for i, data in enumerate(row):
            pdf.set_fill_color(245, 245, 245) if fill else pdf.set_fill_color(255, 255, 255)
            pdf.cell(col_widths[i], 10, data, 1, 0, 'C', fill)
        pdf.ln()
        fill = not fill  # Alternate row background

    pdf.output(output_path)
    print(f"PDF saved to: {output_path}")

# === Run ===
if __name__ == '__main__':
    patients = fetch_patient_details()
    if patients:
        generate_pdf(patients, 'patient_details_report.pdf')
    else:
        print("No patient data found.")
