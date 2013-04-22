<?php
    include_once($BASE_PATH . 'common/DatabaseException.php');

    // Get all news (including comment count)
    function getAllNews() {
        global $db;
        $result = $db->query("SELECT news.*, COUNT(comments.id) as comment_count 
                              FROM news LEFT JOIN comments ON (news.id = news_id) 
                              GROUP BY news.id, news.title, news.introduction, 
                                       news.fulltext, news.section_name");
        return $result->fetchAll();
    }

    // Get a specific news item by id
    function getNewById($id) {
        global $db;

        if (!is_numeric($id)) throw new Exception("Invalid Id");

        $stmt = $db->prepare("SELECT * FROM news WHERE id = ?");
        $stmt->execute(array($id));
        $new = $stmt->fetch();
        if (!$new) throw new Exception("No Such Id");
        return $new;
    }

    function insertNews($title, $introduction, $fulltext, $section_name) {
        global $db;

	$errors = new DatabaseException();

        if (strlen($title) < 3) $errors->addError('title', 'Title Size >= 3');
        if ($title == "") $errors->addError('title', 'Title Required');
        if ($introduction == "") $errors->addError('introduction', 'Introduction Required');

        if ($errors->hasErrors()) throw ($errors);

        try {
            $stmt = $db->prepare("INSERT INTO news VALUES(DEFAULT, ?, ?, ?, ?)");
            $stmt->execute(array($title, $introduction, $fulltext, $section_name));
        } catch (Exception $e) {
            $msg = $e->getMessage();
            if (strpos($msg, 'news_section_name_fkey')) 
		throw DatabaseException::singleField('section', 'No Such Section');
            throw DatabaseException::singleMessage('Unknown Error');
        }

        return $db->lastInsertId('news_id_seq');
    }

    function updateNews($id, $title, $introduction, $fulltext, $section_name) {
        global $db;

        if (strlen($title) < 3) $errors->addError('title', 'Title Size >= 3');
        if ($id == "") $errors->addError('global', 'Id Required');
        if ($title == "") $errors->addError('title', 'Title Required');
        if ($introduction == "") $errors->addError('introduction', 'Introduction Required');

        try {
            $stmt = $db->prepare("UPDATE news SET title = ?, introduction = ?, fulltext = ?, section_name = ? WHERE id = ?");
            $stmt->execute(array($title, $introduction, $fulltext, $section_name, $id));
        } catch (Exception $e) {
            $msg = $e->getMessage();
            if (strpos($msg, 'news_section_name_fkey')) 
		throw DatabaseException::singleField('section', 'No Such Section');
            throw DatabaseException::singleMessage('Unknown Error');
        }
    }

?>
