
create database %%%DBNAME%%%;

create user '%%%USERNAME%%%'@'localhost' identified by '%%%PASSWORD%%%';
grant all on %%%DBNAME%%% to '%%%USERNAME%%%'@'localhost';

use %%%DBNAME%%%;

create table if not exists users (
    id int auto_increment,
    username varchar(64),
    password varchar(256),
    primary key (id)
) engine innodb character set utf8;

# stories, epics, tickets, tasks, projects, etc.
create table if not exists things (
    id int auto_increment,
    parent_id int null,
    column_id int,
    primary key (id)
) engine innodb character set utf8;

# the mapped attributes for this thing
create table if not exists thing_attributes (
    id int auto_increment,
    thing_id int,
    thing_attribute_definition_id int,
    value text,
    primary key (id)
) engine innodb character set utf8;

# defines what things can exist
create table if not exists thing_definitions (
    id int auto_increment,
    thing_name varchar(64),
    thing_description text,
    thing_icon varchar(256),
    child_thing_definition_id int null,
    primary key (id)
) engine innodb character set utf8;

insert into thing_definitions values (0, "Epic",  "A body of work that can be broken into user stories.",                 "src/assets/icons/epic.png",  1),
                                     (1, "Story", "A body of work expressed from the software user's perspective.",       "src/assets/icons/story.png", 2),
                                     (2, "Task",  "A body of work that needs to be completed, but is not a deliverable.", "src/assets/icons/task.png",  null);

# defines attributes availabe to each type of thing
create table if not exists thing_attribute_definitions (
    id int auto_increment,
    thing_definition_id int null, # null means this is something all things have
    attribute_name varchar(256),
    attribute_description text,
    attribute_type varchar(64),
    rules text,
    linked tinyint(1),
    linked_rules text,
    display_on_card tinyint(1),
    primary key (id)
) engine innodb character set utf8;

insert into thing_attribute_definitions values (0, null, "Title",   "The title of the thing."),
                                               (1, null, "Summary", "A detailed summary of the thing."),
                                               (2, null, "Creator", "Who the thing was created by."),
                                               (3, null, "Worker",  "The user who is working on the thing."),
                                               (4, null, "Created", "When the thing was created."),
                                               (5, null, "Updated", "The last time that the thing was updated."),

create table if not exists boards (
    id int auto_increment,
    board_name varchar(256),
    global tinyint(1),
    primary key (id)
) engine innodb character set utf8;

insert into boards values (0, "Main Board", 1);

create table if not exists boards_users (
    id int auto_increment,
    board_id int,
    user_id int,
    board_admin tinyint(1),
    primary key (id)
) engine innodb character set utf8;

create table if not exists columns (
    id int auto_increment,
    board_id int,
    column_name varchar(32),
    primary key (id)
) engine innodb character set utf8;

insert into columns (0, 0, "Backlog"),
                    (1, 0, "To-Do"),
                    (2, 0, "In Progress"),
                    (3, 0, "Done");
