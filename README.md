## Quick Info

<h3>StudyHubs:</h3>

A cloud-based notes sharing platform deployed on AWS.

• Backend: PHP<br>
• Frontend: HTML, CSS, JavaScript<br>
• Database: Amazon RDS (MySQL)<br>
• Cloud Storage: Amazon S3 (PDF Files)<br>
• Hosting: Amazon EC2<br>
• Authentication: Session-Based Login & IAM Role<br>
• Networking: Amazon VPC<br>
• Server Management: AWS Systems Manager (SSM)<br>
• User Roles: Admin & User<br>
• Admin Features: Approve, Reject, Delete, Upload and Manage Notes<br>
• Security: Password Hashing, password_verify(), Session Authentication

## StudyHubs – Cloud-Based Notes Sharing Platform

<h3>Project Overview</h3>

StudyHubs is a cloud-based notes sharing platform deployed on Amazon Web Services (AWS). The application allows students to register, log in securely, upload PDF notes, and access approved study materials. All uploaded notes are reviewed by an administrator before becoming available to other users, ensuring quality and preventing inappropriate content.

The project is built using PHP, MySQL, HTML, CSS and Javascript and deployed on an Amazon EC2 instance. Amazon RDS is used for the database, while Amazon S3 stores all uploaded PDF files. Secure communication between AWS services is achieved using IAM Roles without storing AWS credentials on the server.


## Features
•User Registration<br>
•Secure Login <br>
•Session-based Authentication<br>
•Upload PDF Notes<br>
•Admin Approval System<br>
•Admin Dashboard<br>
•User Dashboard<br>
•Preview PDF Notes<br>
•Download PDF Notes<br>
•Upload Status (Pending / Approved)<br>
•Category-wise Notes<br>
•Responsive User Interface<br>
•Cloud Storage using Amazon S3<br>
•Cloud Database using Amazon RDS<br>

## AWS Services Used

| AWS Service | Purpose |
|-------------|---------|
| Amazon EC2 | Hosts the PHP application |
| Amazon RDS (MySQL) | Stores user and notes information |
| Amazon S3 | Stores uploaded PDF files |
| IAM Role | Provides secure access from EC2 to Amazon S3 without storing AWS credentials |
| AWS Systems Manager (SSM) | Securely manages the EC2 instance without using SSH |
| Amazon VPC | Provides network isolation for AWS resources |
<br>
## Architecture Diagram

![alt text](<Images/Architecture Diagram.png>)


## Project Workflow

#### 1. User Registration
• User creates an account.<br>
• Password is encrypted using password_hash().<br>
• User information is stored in Amazon RDS.<br>

#### 2. Login
• User enters credentials.<br>
• Password is verified using password_verify().<br>
• PHP session is created after successful authentication.<br>

#### 3. Upload Notes
• User uploads a PDF file.<br>
• File is stored in Amazon S3.<br>
• Metadata Metadata (subject, standard, uploader, file name and status) is stored in Amazon RDS.<br>
• Uploaded note status is initially Pending.<br>

#### 4. Admin Review
• Administrator views pending notes.<br>
• Admin can:<br>
 - View<br>
 - Approve<br>
 - Reject<br>

#### 5. View Notes
• Only approved notes are displayed.<br>
• Users can preview PDFs directly from Amazon S3.<br>
• Users can download PDFs securely.<br>

<br>

## Database Overview

### userdetails

| Column | Description |
|----------|-------------|
| id | Unique ID |
| username | Username |
| password | Hashed Password |
| role | Admin/User |


### notes

| Column | Description |
|----------|-------------|
| id | Note ID |
| username | Uploaded By |
| subject | Subject |
| standard | Class |
| file_name | PDF Name |
| status | Pending/Approved |
| uploaded_at | Upload Time |

## Screenshots
### Website
#### • Home Page
![alt text](<Images/website/main dashboard.png>)

#### • Login / Register
![alt text](Images/website/login.png)

#### • User Dashboard
![alt text](<Images/website/user dashboard.png>)

#### • Upload notes 
![alt text](<Images/website/user upload note.png>)

![alt text](<Images/website/user note uploaded.png>)

#### • Notes page
![alt text](<Images/website/get notes.png>)

#### • Admin dashboard
![alt text](<Images/website/admin dashboard.png>)

#### • Review notes
![alt text](<Images/website/notes approval.png>)

#### • Manages notes
![alt text](<Images/website/manage notes.png>)

---

### Amazon EC2
#### • EC2 Instance
![alt text](<Images/ec2/EC2 Instance.png>)

#### • Session manager
![alt text](<Images/ec2/Session manager.png>)

---

### Amazon S3
#### • S3 Bucket
![alt text](<Images/s3/s3 bucket.png>)

#### • S3 Objects
![alt text](Images/s3/objects.png)

---

### Amazon RDS
#### • Database Overview
![alt text](Images/rds/overview.png)

#### • Connectivity & Security
![alt text](Images/rds/connectivity.png)

---

### Database Overview
#### • Overview
![alt text](<Images/rds/db structure.png>)

---

### VPC
#### • Resource Map
![alt text](Images/vpc/Resourcemap.png)

---

### IAM Role
#### • IAM Roles / Policies 
![alt text](Images/IAM/IAMRole.png)

<br>

## AWS Architecture Components

- #### Amazon VPC
    - Public Subnet
    - Internet Gateway
    - Route Table

- #### Amazon EC2
    - Apache
    - PHP
    - Composer

- #### Amazon RDS (MySQL)

- #### Amazon S3
    - PDF Storage

- #### IAM Role
    - EC2 → S3 Access

- #### AWS Systems Manager
    - Server Management


## Technologies Used
- ### Frontend
  - HTML <br>
  - CSS<br>
  - Javascript

- ### backend
  - PHP

- ### Database
  - MySQL (Amazon RDS)

- ### Cloud  Services
  - Amazon EC2<br>
  - Amazon RDS<br>
  - Amazon S3<br>
  - AWS IAM<br>
  - AWS Systems Manager (SSM)<br>
  - Amazon VPC<br>

- ### Development Tools
  - Visual Studio Code<br>
  - Git<br>
  - GitHub**<br>
  - Amazon Linux 2023<br>
  - Apache HTTP Server<br>
  - Composer<br>
  - MySQL CLI<br>


## Security Features
•Password Hashing using password_hash()<br>
•Password Verification using password_verify()<br>
•Session-Based Authentication<br>
•IAM Role (No AWS Access Keys)<br>
•Amazon RDS Private Database<br>
•Amazon S3 Bucket Policy<br>

## Repository Structure
~~~
StudyHubs/
│
├── admin/
├── assets/
│   ├── css/
│   └── image/
├── notes/
├── vendor/
│
├── README.md
├── studyhubs_db.sql
├── composer.json
├── composer.lock
│
├── config.php
├── index.php
├── login.php
├── register.php
├── notes.php
├── upload_note_user.php
└── ...
~~~

## Learning Outcomes

#### Through this project, I gained practical experience with:

Deploying PHP applications on Amazon EC2
Configuring Amazon RDS MySQL
Integrating Amazon S3 for cloud file storage
Managing EC2 securely using Systems Manager (SSM)
Implementing IAM Roles for secure AWS access
Configuring custom VPC networking
Managing Linux servers using Bash commands
Deploying full-stack web applications on AWSz