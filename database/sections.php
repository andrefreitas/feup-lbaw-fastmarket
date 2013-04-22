<?php

    // Get all sections
    function getAllSections() {
        global $db;
        $result = $db->query("SELECT * FROM sections");
        return $result->fetchAll();
    }

    // Get all news from a specific section (including comments)
    function getAllSectionNews($name) {
        global $db;
        $result = $db->prepare("SELECT news.*, COUNT(comments.id) as comment_count 
                                FROM news LEFT JOIN comments ON (news.id = news_id)
                                WHERE section_name = ?
                                GROUP BY news.id, news.title, news.introduction, 
                                         news.fulltext, news.section_name");
        $result->execute(array($name));
        return $result->fetchAll();
    }

?>
