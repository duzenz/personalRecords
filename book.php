<html>
    <head>
        <?php include 'head.php';?>
    </head>
</html>

<!--
<div class="filtering">
    <form>
        Book Name: <input type="text" name="book_name" id="book_name" />
        <button type="submit" id="LoadRecordsButton">Load records</button>
    </form>
</div>
-->

<div id="BookTableContainer"></div>

<script type="text/javascript">
    $(document).ready(function () {
        $('#BookTableContainer').jtable({
            title: 'Table of book',
			paging: true,
			sorting: true,
			defaultSorting: 'book_name ASC',
            actions: {
            	listAction: 'book/BookActions.php?action=list',
				createAction: 'book/BookActions.php?action=create',
				updateAction: 'book/BookActions.php?action=update',
			    deleteAction: 'book/BookActions.php?action=delete'
            },
            fields: {
                id: {
                    key: true,
                    list: false
                },
                book_name: {
                    title: 'Book Name',
                    //width: '40%'
                },
                writer : {
                    title: 'Writer',
                },
                start_date : {
                    title: 'Start Date',
                    type : 'date',
                },
                finish_date : {
                    title: 'Finish Date',
                    type : 'date',
                },
                publisher : {
                    title : 'Publisher',
                },
                language : {
                    title : 'Language',
                },
                comment : {
                    title : 'Comment',
                    type : 'textarea',
                },
                page_count : {
                    title : 'Page Count',
                    type : 'number',
                    width : '1%',
                },
                grade : {
                    title : 'Grade',
                    type : 'number',
                    width: '1%',
                },

            }
        });

        //Re-load records when user click 'load records' button.
        /*$('#LoadRecordsButton').click(function (e) {
            e.preventDefault();
            $('#BookTableContainer').jtable('load', {
            	book_name: $('#book_name').val(),
            });
        });

        //Load all records when page is first shown
        $('#LoadRecordsButton').click();*/

      $('#BookTableContainer').jtable('load');
    });
</script>