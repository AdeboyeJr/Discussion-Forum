# Discussion Forum

## Author: Adeboye Adegbenro Jr.

##### Description

A simple online discussion forum where users can post any topic and write a post about said topic. Posts include the user's email address, their discussion post, and the day the post was published.

##### Implementation

Users begin with the add topic web page `addtopic.html`. Here, users can create a topic of their choosing and include their first post. The page then sends a post request to the `do_addtopic.php` script. This script sanitizes the input from the post request and inserts the data into the discussion forum database.

The following MySQL commands inserts the forum topic and post to discussion forum database:

```php
"INSERT INTO forum_topics (topic_title, topic_create_time, topic_owner) VALUES ('".$clean_topic_title. "'
, now(), '".$clean_topic_owner."')";


"INSERT INTO forum_posts (topic_id, post_text, post_create_time, post_owner) VALUES
    ('".$topic_id."', '".$clean_post_text."', now(), '".$clean_topic_owner."')";

```

The user is notified that the post has sucessfully been added.

Users can naviate to the topic list to view all topics and posts that have been published on the site. A MySQL query selects all the topics that have been published and lists them in a table. The table contains data for the topic, the number of posts on that topic and the date the topic was created.

When users click on the topic title, they are directed to the `showtopic.php` page where they can view data on all the posts that were published on said topic. Data is presented in a table and users can reply to each post. Selecting `REPLY TO POST` directs them to the `replytopost.php` page where they can add their own opinions to the topic.

#### Host

Domain: adedev.online

Database connection:

```php
mysqli_connect("localhost", "u667897109_Ade", "T#st1125", "u667897109_Data");
```

#### Dependencies

You need an internet browser that supports JavaScript to run this web application. 