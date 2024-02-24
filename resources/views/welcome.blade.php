<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AJAX Search Form</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body>
    <div class="container">
        <h2>Search Products</h2>
        <form id="searchForm">
            <input type="text" id="searchQuery" placeholder="Search products...">
            <button type="submit">Search</button>
        </form>
        <div id="searchResults"></div>
    </div>

    <script>
        $(document).ready(function() {
            $('#searchForm').submit(function(event) {
                event.preventDefault(); // Prevent the form from submitting normally
                
                var query = $('#searchQuery').val(); // Get the search query
                
                // Send AJAX request
                $.ajax({
                    type: 'GET',
                    url: '{{ route('home') }}', // Replace this with your route
                    data: { query: query },
                    success: function(response) {
                        displaySearchResults(response); // Display search results
                    },
                    error: function(xhr, status, error) {
                        console.error(error);
                    }
                });
            });

            // Function to display search results
            function displaySearchResults(results) {
                var searchResults = $('#searchResults');
                searchResults.empty(); // Clear previous search results
                
                if (results.length > 0) {
                    $.each(results, function(index, result) {
                        var resultItem = '<div>' +
                                            '<h3>' + result.name + '</h3>' +
                                            '<p>' + result.description + '</p>' +
                                         '</div>';
                        searchResults.append(resultItem);
                    });
                } else {
                    searchResults.append('<p>No results found.</p>');
                }
            }
        });
    </script>
</body>
</html>
