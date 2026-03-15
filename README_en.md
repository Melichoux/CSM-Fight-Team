# CSM Fight Team Project

This project is about redesigning the website of a sports club.

## Prerequisites

The installation of a LAMP environment as well as nodejs, github, docker, phpmyadmin, vscode and gitbash are necessary to work on this project.
## Objectives

Create a website that will provide a good user experience and facilitate navigation on this new site


# CSM Fight Team - Club Website

Creation: December 15, 2025
This project stems from the desire to improve the website of a sports club.
![Screenshot](./images/screenshot.png)

## Description

Club information website with access to the following information:
- club contact details,
- information about classes,
- club life info page
- an article catalogue,
- a photo gallery,
- a link to external websites (including the judo federation website),
- a contact page
- a registration area,
- a login area,
- admin account to modify the site content

## Frontend Skills (Part 1)

### Creating static web or mobile web user interfaces

- **Skills**: Web page development using HTML5 and CSS3, understanding of responsive layout.
- **Example**: Coding in HTML5 and CSS3 to structure web pages and apply styles.

### Developing the dynamic part of web or mobile web user interfaces

- **Skills**: JavaScript programming, use of libraries and frameworks to enhance user interaction.
- **Example**: Using JavaScript to make interfaces interactive.

### Features

- Display of an article catalogue using the fetch method
- Article search by keywords
- Article details page
- Modern and accessible design
- Contact page with email sending via EmailJS

### Technologies used

- HTML5 (semantic tags)
- CSS3 (Flexbox, Grid, Media Queries)
- JavaScript ES6 (Fetch API, Modules)
- EmailJS
- Vercel: https://csm-fight-team.vercel.app/

## Backend Skills (Part 2)

### Skills
 - Setting up a relational database,
 - Developing SQL and NoSQL data access components,
 - Developing server-side business components,
 - Documenting the deployment of a dynamic web or mobile web application.

### Features

- Display of an article catalogue using the fetch method
- Article search by keywords
- Article details page

### Technologies used
 - LAMP
 - Mysql
 - PHP 8.4.18
 - Phpmyadmin 5.2.2
 - Docker

## Installation

1. Clone the repository
```bash
git clone https://github.com/Melichoux/CSM-Fight-Team.git
```

## Database

1. Merise
----------

[Click to access the data dictionary](<assets/images/merise/Dictionnaire de données.pdf>)

MCD schema (looping):
![MCD schema](assets/images/merise/mcd-csm.png)
MLD schema (looping):
![MLD schema](assets/images/merise/mld-csm.png)
MPD schema (phpmyadmin):
![MPD schema](assets/images/merise/mpd-csm.png)

2. Database creation
-----------
Here is the code to recreate the database:
```sql
DROP DATABASE IF EXISTS csm_fight_team;
CREATE DATABASE csm_fight_team;
USE csm_fight_team;

CREATE TABLE csm_Form_contact(
   id_form INT UNSIGNED AUTO_INCREMENT,
   last_name VARCHAR(100) NOT NULL,
   first_name VARCHAR(100) NOT NULL,
   email VARCHAR(254) NOT NULL,
   content TEXT NOT NULL,
   created_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL,
   check_email BOOLEAN DEFAULT false,
   PRIMARY KEY(id_form)
);

CREATE TABLE csm_user(
   id_user INT UNSIGNED AUTO_INCREMENT,
   last_name VARCHAR(100) NOT NULL,
   first_name VARCHAR(100) NOT NULL,
   email VARCHAR(254) NOT NULL,
   password VARCHAR(255) NOT NULL,
   created_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL,
   reset_token VARCHAR(100),
   expiry_reset DATETIME,
   role ENUM('admin','user') DEFAULT 'user',
   PRIMARY KEY(id_user),
   UNIQUE(email)
);

CREATE TABLE csm_article(
   id_article INT UNSIGNED AUTO_INCREMENT,
   date_event DATE,
   img_event VARCHAR(255),
   title VARCHAR(200),
   intro VARCHAR(255),
   description TEXT,
   created_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL,
   id_user INT UNSIGNED NOT NULL DEFAULT 1,
   PRIMARY KEY(id_article),
   FOREIGN KEY(id_user) REFERENCES csm_user(id_user)
      ON DELETE CASCADE
      ON UPDATE CASCADE
);

CREATE TABLE csm_tag(
   id_tag INT UNSIGNED AUTO_INCREMENT,
   tag VARCHAR(50) NOT NULL,
   PRIMARY KEY(id_tag),
   UNIQUE(tag)
);

CREATE TABLE csm_time_slot(
   id_time_slot INT UNSIGNED AUTO_INCREMENT,
   start_time TIME NOT NULL,
   end_time TIME NOT NULL,
   label_cours VARCHAR(100),
   age_min TINYINT UNSIGNED NOT NULL CHECK (age_min >= 3),
   age_max TINYINT UNSIGNED NULL,
   created_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL,
   id_user INT UNSIGNED NOT NULL,
   PRIMARY KEY(id_time_slot),
   FOREIGN KEY(id_user) REFERENCES csm_user(id_user)
      ON DELETE CASCADE
      ON UPDATE CASCADE
);

CREATE TABLE csm_slot_day(
   id_slot_day INT UNSIGNED NOT NULL AUTO_INCREMENT,
   training_day ENUM('Lundi','Mardi','Mercredi','Jeudi','Vendredi','Samedi','Dimanche') NOT NULL,
   PRIMARY KEY(id_slot_day),
   UNIQUE(training_day)
);

CREATE TABLE csm_comment(
   id_comment INT UNSIGNED NOT NULL AUTO_INCREMENT,
   description TEXT NOT NULL,
   last_name VARCHAR(50) NOT NULL,
   first_name VARCHAR(50) NOT NULL,
   created_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL,
   id_user INT UNSIGNED NOT NULL,
   PRIMARY KEY(id_comment),
   FOREIGN KEY(id_user) REFERENCES csm_user(id_user)
      ON DELETE CASCADE
      ON UPDATE CASCADE
);

CREATE TABLE csm_album(
   id_album INT UNSIGNED AUTO_INCREMENT,
   title VARCHAR(200) NOT NULL,
   cover_img VARCHAR(250),
   created_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL,
   PRIMARY KEY(id_album),
   UNIQUE(title)
);

CREATE TABLE csm_photo(
   id_photo INT UNSIGNED AUTO_INCREMENT,
   alt_text VARCHAR(250) NOT NULL,
   img_path VARCHAR(250) NOT NULL,
   created_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL,
   PRIMARY KEY(id_photo)
);

-- Tables associatives

CREATE TABLE csm_article_tag(
   id_article INT UNSIGNED NOT NULL,
   id_tag INT UNSIGNED NOT NULL,
   PRIMARY KEY(id_article, id_tag),
   FOREIGN KEY(id_article) REFERENCES csm_article(id_article)
      ON DELETE CASCADE
      ON UPDATE CASCADE,
   FOREIGN KEY(id_tag) REFERENCES csm_tag(id_tag)
      ON DELETE CASCADE
      ON UPDATE CASCADE
);

CREATE TABLE csm_article_comment(
   id_article INT UNSIGNED NOT NULL,
   id_comment INT UNSIGNED NOT NULL,
   PRIMARY KEY(id_article, id_comment),
   FOREIGN KEY(id_article) REFERENCES csm_article(id_article)
      ON DELETE CASCADE
      ON UPDATE CASCADE,
   FOREIGN KEY(id_comment) REFERENCES csm_comment(id_comment)
      ON DELETE CASCADE
      ON UPDATE CASCADE
);

CREATE TABLE csm_user_comment(
   id_user INT UNSIGNED NOT NULL,
   id_comment INT UNSIGNED NOT NULL,
   like_dislike BOOLEAN,
   PRIMARY KEY(id_user, id_comment),
   FOREIGN KEY(id_user) REFERENCES csm_user(id_user)
      ON DELETE CASCADE
      ON UPDATE CASCADE,
   FOREIGN KEY(id_comment) REFERENCES csm_comment(id_comment)
      ON DELETE CASCADE
      ON UPDATE CASCADE
);

CREATE TABLE csm_photo_album(
   id_album INT UNSIGNED NOT NULL,
   id_photo INT UNSIGNED NOT NULL,
   PRIMARY KEY(id_album, id_photo),
   FOREIGN KEY(id_album) REFERENCES csm_album(id_album)
      ON DELETE CASCADE
      ON UPDATE CASCADE,
   FOREIGN KEY(id_photo) REFERENCES csm_photo(id_photo)
      ON DELETE CASCADE
      ON UPDATE CASCADE
);

CREATE TABLE csm_time_slot_day(
   id_time_slot INT UNSIGNED NOT NULL,
   id_slot_day INT UNSIGNED NOT NULL,
   PRIMARY KEY(id_time_slot, id_slot_day),
   FOREIGN KEY(id_time_slot) REFERENCES csm_time_slot(id_time_slot)
      ON DELETE CASCADE
      ON UPDATE CASCADE,
   FOREIGN KEY(id_slot_day) REFERENCES csm_slot_day(id_slot_day)
      ON DELETE CASCADE
      ON UPDATE CASCADE
);
...
```
Table summary:

- csm_Form_contact
- csm_user_
- csm_article
- csm_tag
- csm_time_slot
- csm_slot_day
- csm_comment
- csm_album
- csm_photo

--- associative tables ---

- csm_article_tag
- csm_article_comment
- csm_user_comment
- csm_photo_album
- csm_time_slot_day
----------------------