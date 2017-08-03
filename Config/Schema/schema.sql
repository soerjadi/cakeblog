--
--  Table stucture for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
    `id`              INT             NOT NULL PRIMARY KEY AUTO_INCREMENT,
    `username`        VARCHAR(45)     NOT NULL,
    `password`        VARCHAR(60)     NOT NULL,
    `name`            VARCHAR(100)    NOT NULL,
    `email`           VARCHAR(100)    NOT NULL,
    `created_time`    TIMESTAMP       NOT NULL default now(),
    `updated_time`    TIMESTAMP       NULL,
    `last_login`      TIMESTAMP       NULL,
    `last_login_old`  TIMESTAMP       NULL,
    `role`            SMALLINT        NOT NULL default 1 -- 0: Admin, 1: Author
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



CREATE TABLE IF NOT EXISTS `article` (
    `id`              INT             NOT NULL PRIMARY KEY AUTO_INCREMENT,
    `title`           VARCHAR(160)    NOT NULL ,
    `content`         TEXT            NOT NULL ,
    `creation_time`   TIMESTAMP       NOT NULL default now(),
    `updated_time`    TIMESTAMP       NULL ,
    `author_id`       INT             NOT NULL ,
    `published`       TINYINT         NOT NULL default 0, -- 0: Not published, 1: published

) ENGINE=InnoDB DEFAULT CHARSET=utf8;

ALTER TABLE "article" ADD CONSTRAINT "fk_article_author_id" FOREIGN KEY("author_id") REFERENCES "users"("id");

-- password: admin123123
INSERT INTO users(id, username, password, name, email, role) VALUES(1, 'admin', '$2a$10$JwPXuj1chl.aBWDOC/HQJOd08RjjTbBK2MI.covg1d1RAxpeTzFsK', 'admin', 'admin@mail.com', 0);

--password: user123123
INSERT INTO users(id, username, password, name, email, role) VALUES(2, 'user', '$2a$10$PwRuDp3uY6lH3nWHa1DHEONUJF98BcpnIyxWL6qz.wwGXMMW2usci', 'user', 'user@mail.com', 1);
