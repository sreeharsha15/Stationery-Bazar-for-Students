/* To Create user table */

CREATE TABLE `usertab` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `code` mediumint(50) NOT NULL,
  `status` text NOT NULL,
  `gender` varchar(255) NOT NULL,
  `phonenum` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

ALTER TABLE `usertab`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `usertab`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

/*-------------------------------------*/

/* To create logininfo table */

CREATE TABLE `logininfo`(
  `name` varchar(255) NOT NULL,
   `email` varchar(255) NOT NULL,
    `loginid` int(11)  NOT NULL,
    `dttm` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

ALTER TABLE `logininfo`
  ADD PRIMARY KEY (`loginid`);

ALTER TABLE `logininfo`
  MODIFY `loginid` int(11) NOT NULL AUTO_INCREMENT;

/*------------------------------------------------*/

/* to create table acceptreq */

CREATE TABLE `acceptreq`(
  `acid` int(11) NOT NULL,
  `rid` int(11) NOT NULL,
  `adid` int(11) NOT NULL,
  `acname` varchar(255) NOT NULL,
  `accemail` varchar(255) NOT NULL,
  `accphone` varchar(30) NOT NULL,
  `reemail` varchar(255) NOT NULL
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

ALTER TABLE `acceptreq`
  ADD PRIMARY KEY (`acid`);

ALTER TABLE `acceptreq`
  MODIFY `acid` int(11) NOT NULL AUTO_INCREMENT;

  /*------------------------------------------------*/

  /* to create table admin */

  CREATE TABLE `admin`(
    `adminid` int(11) NOT NULL,
    `uname` varchar(255) NOT NULL,
    `password` varchar(255) NOT NULL
  )ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

  ALTER TABLE `admin`
    ADD PRIMARY KEY (`adminid`);

  ALTER TABLE `admin`
    MODIFY `adminid` int(11) NOT NULL AUTO_INCREMENT;

/*--------------------------------------------------------*/


/* to create  table apron */

CREATE TABLE `apron`(
  `name` varchar(200) NOT NULL,
  `title` varchar(200)  NOT NULL,
  `email` varchar(200) NOT NULL,
  `descrip` text NOT NULL,
  `type` varchar(200) NOT NULL,
  `price` int(11) NOT NULL,
  `id` int(11) NOT NULL,
  `image` varchar(255) NOT NULL
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

ALTER TABLE `apron`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `apron`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

/*---------------------------------------------------------*/

/* to create  table books */

CREATE TABLE `books`(
  `name` varchar(200) NOT NULL,
  `title` varchar(200)  NOT NULL,
  `email` varchar(200) NOT NULL,
  `descrip` text NOT NULL,
  `type` varchar(200) NOT NULL,
  `price` int(11) NOT NULL,
  `id` int(11) NOT NULL,
  `image` varchar(255) NOT NULL
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

ALTER TABLE `books`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `books`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

/*---------------------------------------------------------*/

/* to create  table stn */

CREATE TABLE `stn`(
  `name` varchar(200) NOT NULL,
  `title` varchar(200)  NOT NULL,
  `email` varchar(200) NOT NULL,
  `descrip` text NOT NULL,
  `type` varchar(200) NOT NULL,
  `price` int(11) NOT NULL,
  `id` int(11) NOT NULL,
  `image` varchar(255) NOT NULL
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

ALTER TABLE `stn`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `stn`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

/*---------------------------------------------------------*/

/* to create table rejectreq */

CREATE TABLE `rejectreq`(
  `rejid` int(11) NOT NULL,
  `rid` int(11) NOT NULL,
  `adid` int(11) NOT NULL,
  `reqemail` varchar(255) NOT NULL,
   `reqname` varchar(255) NOT NULL
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

ALTER TABLE `rejectreq`
  ADD PRIMARY KEY (`rejid`);

ALTER TABLE `rejectreq`
  MODIFY `rejid` int(11) NOT NULL AUTO_INCREMENT;

/*---------------------------------------------------------*/

/* to create table report */

CREATE TABLE `report`(
  `reportid` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `adid` int(11) NOT NULL,
  `dttm` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `type` varchar(255) NOT NULL
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

ALTER TABLE `report`
  ADD PRIMARY KEY (`reportid`);

ALTER TABLE `report`
  MODIFY `reportid` int(11) NOT NULL AUTO_INCREMENT;

/*---------------------------------------------------------*/

/* to create table request */

CREATE TABLE `request`(
  `rid` int(11) NOT NULL,
  `adid` int(11) NOT NULL,
  `reqemail` varchar(255) NOT NULL,
  `accpemail` varchar(255) NOT NULL,
  `reqname` varchar(255) NOT NULL,
  `accpname` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

ALTER TABLE `request`
  ADD PRIMARY KEY (`rid`);

ALTER TABLE `request`
  MODIFY `rid` int(11) NOT NULL AUTO_INCREMENT;

/*---------------------------------------------------------*/
