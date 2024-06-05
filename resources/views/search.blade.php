<div class="search-container">
    <input type="text" id="searchInput" placeholder="Search users...">
    <button type="button" id="searchButton">Search</button>
</div>
<div id="searchResults"></div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        document.getElementById('searchButton').addEventListener('click', function () {
            var keyword = document.getElementById('searchInput').value;

            axios.post('/search-users', { query: keyword })
                .then(function (response) {
                    displaySearchResults(response.data);
                })
                .catch(function (error) {
                    console.error('An error occurred during search:', error);
                });
        });
    });

    function displaySearchResults(results) {
        var searchResults = document.getElementById('searchResults');
        searchResults.innerHTML = '';

        results.forEach(function (user) {
            var userDiv = document.createElement('div');
            userDiv.innerHTML = '<p>Username: ' + user.username + '</p>' +
                                '<p>First Name: ' + user.firstname + '</p>' +
                                '<p>Last Name: ' + user.lastname + '</p>' +
                                '<hr>';
            searchResults.appendChild(userDiv);
        });
    }
</script>
