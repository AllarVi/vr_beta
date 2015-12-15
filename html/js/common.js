var Search = {

    initSearchInput: function () {
        var searchInput = $('#searchInput');

        searchInput.on('input', function (e) {
            e.preventDefault();

            var input = searchInput.val();

            $.getJSON('https://52.29.136.34/req.php?search=' + input, function (json) {
                var searchResult = $('#searchResult');
                searchResult.text("");
                if (json.result != 'No result') {
                    searchResult.text(json.result);
                }
            });
        });
    }
};