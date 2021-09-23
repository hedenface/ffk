
create database %%%DBNAME%%%;

create user '%%%USERNAME%%%'@'localhost' identified by '%%%PASSWORD%%%';
grant all on %%%DBNAME%%%.* to '%%%USERNAME%%%'@'localhost';

use %%%DBNAME%%%;

create database ffk;
grant all on ffk.* to 'ffk'@'localhost';

flush privileges;

use ffk;


########
#
# users
#
########

create table if not exists users (
    id int auto_increment,
    username varchar(64),
    hash varchar(64),
    admin tinyint not null,
    enabled tinyint not null,
    default_new_item int not null,
    primary key (id)
) engine innodb character set utf8mb4;


#################################################
#
# stories, epics, tickets, tasks, projects, etc.
#
#################################################

create table if not exists things (
    id int auto_increment,
    parent_id int null,
    column_id int,
    thing_definition_id int,
    archived tinyint not null,
    primary key (id)
) engine innodb character set utf8mb4;


#######################################
#
# the mapped attributes for this thing
#
#######################################

create table if not exists thing_attributes (
    id int auto_increment,
    thing_id int,
    thing_attribute_definition_id int,
    value text,
    primary key (id)
) engine innodb character set utf8mb4;


################################
#
# defines what things can exist
#
################################

create table if not exists thing_definitions (
    id int auto_increment,
    thing_name varchar(64),
    thing_description text,
    thing_icon varchar(256),
    child_thing_definition_id int null,
    enabled tinyint not null,
    primary key (id)
) engine innodb character set utf8mb4;

insert into thing_definitions values (1, "Epic",  "A body of work that can be broken into user stories.",                 "src/assets/icons/epic.png",  2,    1),
                                     (2, "Story", "A body of work expressed from the software user's perspective.",       "src/assets/icons/story.png", 3,    1),
                                     (3, "Task",  "A body of work that needs to be completed, but is not a deliverable.", "src/assets/icons/task.png",  null, 1);


####################################################
#
# defines attributes availabe to each type of thing
#
####################################################

create table if not exists thing_attribute_definitions (
    id int auto_increment,
    thing_definition_id int null, # null means this is something all things have
    attribute_name varchar(128),
    attribute_title varchar(256),
    attribute_description text,
    attribute_type varchar(64),
    attribute_options text,
    rules text,
    linked tinyint not null,
    linked_rules text,
    display_on_card tinyint not null,
    user_can_change tinyint not null,
    enabled tinyint not null,
    primary key (id)
) engine innodb character set utf8mb4;

insert into thing_attribute_definitions values (1, null, "title",   "Title",        "The title of the thing.",                   "text",       "", "", 0, "", 1, 1, 1),
                                               (2, null, "summary", "Summary",      "A detailed summary of the thing.",          "large-text", "", "", 0, "", 0, 1, 1),
                                               (3, null, "creator", "Creator",      "Who the thing was created by.",             "user",       "", "", 1, "", 0, 0, 1),
                                               (4, null, "worker",  "Worker",       "The user who is working on the thing.",     "user",       "", "", 1, "", 1, 0, 1),
                                               (5, null, "created", "Created",      "When the thing was created.",               "datetime",   "", "", 0, "", 0, 0, 1),
                                               (6, null, "updated", "Updated",      "The last time that the thing was updated.", "datetime",   "", "", 0, "", 0, 0, 1),

                                               (7,    2, "points",  "Story Points", "How much effort this story will take.",     "number",     "", "", 0, "", 1, 1, 1);


#########
#
# boards
#
#########

create table if not exists boards (
    id int auto_increment,
    board_name varchar(256),
    global tinyint not null,
    enabled tinyint not null,
    primary key (id)
) engine innodb character set utf8mb4;

insert into boards values (1, "Main Board", 1, 1);


###################################
#
# which users can use which boards
#
###################################

create table if not exists board_users (
    id int auto_increment,
    board_id int,
    user_id int,
    default_new_item int,
    board_admin tinyint not null,
    primary key (id)
) engine innodb character set utf8mb4;


############################
#
# the columns of each board
#
############################

create table if not exists columns (
    id int auto_increment,
    board_id int,
    column_name varchar(32),
    enabled tinyint not null,
    primary key (id)
) engine innodb character set utf8mb4;

insert into columns values (1, 0, "Backlog",     1),
                           (2, 0, "To-Do",       1),
                           (3, 0, "In Progress", 1),
                           (4, 0, "Done",        1);


############################################
#
# an audit trail of everything done/changed
#
############################################

create table if not exists audit_log (
    id bigint,
    user_id int,
    related_id int,
    related_type varchar(32),
    information text,
    primary key (id)
) engine innodb character set utf8mb4;
