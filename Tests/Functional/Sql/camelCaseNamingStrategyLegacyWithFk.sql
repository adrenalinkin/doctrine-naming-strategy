CREATE TABLE User (
    id VARCHAR(255) NOT NULL,
    firstCommentId VARCHAR(255) DEFAULT NULL,
    PRIMARY KEY(id),
    CONSTRAINT FK_2DA179777EB9366D FOREIGN KEY (firstCommentId) REFERENCES Comment (id)
        NOT DEFERRABLE INITIALLY IMMEDIATE
);
CREATE INDEX IDX_2DA179777EB9366D ON User (firstCommentId);
CREATE TABLE UserFavoriteComments (
    UserId VARCHAR(255) NOT NULL,
    CommentId VARCHAR(255) NOT NULL,
    PRIMARY KEY(UserId, CommentId),
    CONSTRAINT FK_ED301B7A631A48FA FOREIGN KEY (UserId) REFERENCES User (id) ON DELETE CASCADE
        NOT DEFERRABLE INITIALLY IMMEDIATE,
    CONSTRAINT FK_ED301B7AE4614156 FOREIGN KEY (CommentId) REFERENCES Comment (id) ON DELETE CASCADE
        NOT DEFERRABLE INITIALLY IMMEDIATE
);
CREATE INDEX IDX_ED301B7A631A48FA ON UserFavoriteComments (UserId);
CREATE INDEX IDX_ED301B7AE4614156 ON UserFavoriteComments (CommentId);
CREATE TABLE UserReadComments (
    UserId VARCHAR(255) NOT NULL,
    CommentId VARCHAR(255) NOT NULL,
    PRIMARY KEY(UserId, CommentId),
    CONSTRAINT FK_96EFAC63631A48FA FOREIGN KEY (UserId) REFERENCES User (id) ON DELETE CASCADE
        NOT DEFERRABLE INITIALLY IMMEDIATE,
    CONSTRAINT FK_96EFAC63E4614156 FOREIGN KEY (CommentId) REFERENCES Comment (id) ON DELETE CASCADE
        NOT DEFERRABLE INITIALLY IMMEDIATE
);
CREATE INDEX IDX_96EFAC63631A48FA ON UserReadComments (UserId);
CREATE INDEX IDX_96EFAC63E4614156 ON UserReadComments (CommentId);
CREATE TABLE Comment (
    id VARCHAR(255) NOT NULL,
    authorId VARCHAR(255) DEFAULT NULL,
    PRIMARY KEY(id),
    CONSTRAINT FK_5BC96BF0A196F9FD FOREIGN KEY (authorId) REFERENCES User (id)
        NOT DEFERRABLE INITIALLY IMMEDIATE
);
CREATE INDEX IDX_5BC96BF0A196F9FD ON Comment (authorId);
