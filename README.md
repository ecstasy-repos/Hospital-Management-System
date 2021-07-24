# Hospital-Management-System

## Description

This Project is a **Hospital Management System Website** , where **admin, patient, doctor, pharmacist, nurse** can create account, **login with their credentials**. Also, Patients can **book appointments** to any of the doctors. Doctors can **accept the appointments** requested by different patients. Patients are allocated nurses for their treatment. Doctors can **give prescription** to the patients and stores **Reports** for the patients. Patients can send those prescription to the pharmacist to **buy** Medicines. Pharmacist accepts the requested prescribed medicines and **sells them those medicines** to the patient and **sends bill** to that patient in return.
It is built on LAMP stack(Linux, Apache, MySQL, php).

## Demo Video Link for the Project

[Demo Video Link- https://drive.google.com/file/d/1VBqF6QDoONeAW5yz-JgEpqiYkDX167Nz/view?usp=sharing](https://drive.google.com/file/d/1VBqF6QDoONeAW5yz-JgEpqiYkDX167Nz/view?usp=sharing)


## Project setup

### Clone the project to your <clone_source_folder>

```
  git clone https://github.com/ecstasy-repos/Hospital-Management-System.git
```

### Add the project folder to the apache server folder in your linux machine

```
  cp -R <clone_source_folder> /var/www/html
```

You might also need to change permissions if you want to make changes to the files in this folder. Can Try out this.

```
  sudo chmod  o+w /var/www/html
  
```
 Go into /include/connection.php and add credentials for your own mysql database.

 In your mysql workbench import the hms.sql file into the above database.

 Go and checkout the localhost to see the effect!!.
