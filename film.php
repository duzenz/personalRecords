<html>
    <head>
        <?php include 'head.php';?>
    </head>
</html>

<div id="FilmTableContainer"></div>

<script type="text/javascript">
    $(document).ready(function () {
        $('#FilmTableContainer').jtable({
            title: 'Table of film',
			paging: true,
			sorting: true,
			defaultSorting: 'name ASC',
            actions: {
            	listAction: 'film/FilmActions.php?action=list',
            	createAction: 'film/FilmActions.php?action=create',
				updateAction: 'film/FilmActions.php?action=update',
			    deleteAction: 'film/FilmActions.php?action=delete'
            },
            fields: {
                id: {
                    key: true,
                    list: false
                },
                name: {
                    title: 'Film Name',
                },
                director : {
                    title: 'Director',
                },
                favourite : {
                    title: 'Favourite',
                },
                watch_date : {
                    title: 'Watch Date',
                    //type : 'date',
                },
                release_date : {
                    title: 'Release Date',
                },
                comment : {
                    title: 'Comment',
                    type : 'textarea',
                },
                grade : {
                    title: 'Grade',
                }
            }
        });

        $('#FilmTableContainer').jtable('load');
    });
</script>