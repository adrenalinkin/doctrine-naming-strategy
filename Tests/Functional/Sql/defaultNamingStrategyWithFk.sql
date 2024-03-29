CREATE TABLE User (
    id VARCHAR(255) NOT NULL,
    firstComment_id VARCHAR(255) DEFAULT NULL,
    PRIMARY KEY(id),
    CONSTRAINT FK_2DA179776A54F90 FOREIGN KEY (firstComment_id) REFERENCES Comment (id)
        NOT DEFERRABLE INITIALLY IMMEDIATE
);
CREATE INDEX IDX_2DA179776A54F90 ON User (firstComment_id);
CREATE TABLE UserFavoriteComments (
    user_id VARCHAR(255) NOT NULL,
    comment_id VARCHAR(255) NOT NULL,
    PRIMARY KEY(user_id, comment_id),
    CONSTRAINT FK_ED301B7AA76ED395 FOREIGN KEY (user_id) REFERENCES User (id) ON DELETE CASCADE
        NOT DEFERRABLE INITIALLY IMMEDIATE,
    CONSTRAINT FK_ED301B7AF8697D13 FOREIGN KEY (comment_id) REFERENCES Comment (id) ON DELETE CASCADE
        NOT DEFERRABLE INITIALLY IMMEDIATE
);
CREATE INDEX IDX_ED301B7AA76ED395 ON UserFavoriteComments (user_id);
CREATE INDEX IDX_ED301B7AF8697D13 ON UserFavoriteComments (comment_id);
CREATE TABLE UserReadComments (
    user_id VARCHAR(255) NOT NULL,
    comment_id VARCHAR(255) NOT NULL,
    PRIMARY KEY(user_id, comment_id),
    CONSTRAINT FK_96EFAC63A76ED395 FOREIGN KEY (user_id) REFERENCES User (id) ON DELETE CASCADE
        NOT DEFERRABLE INITIALLY IMMEDIATE,
    CONSTRAINT FK_96EFAC63F8697D13 FOREIGN KEY (comment_id) REFERENCES Comment (id) ON DELETE CASCADE
        NOT DEFERRABLE INITIALLY IMMEDIATE
);
CREATE INDEX IDX_96EFAC63A76ED395 ON UserReadComments (user_id);
CREATE INDEX IDX_96EFAC63F8697D13 ON UserReadComments (comment_id);
CREATE TABLE Comment (
    id VARCHAR(255) NOT NULL,
    author_id VARCHAR(255) DEFAULT NULL,
    PRIMARY KEY(id),
    CONSTRAINT FK_5BC96BF0F675F31B FOREIGN KEY (author_id) REFERENCES User (id)
        NOT DEFERRABLE INITIALLY IMMEDIATE
);
CREATE INDEX IDX_5BC96BF0F675F31B ON Comment (author_id);
