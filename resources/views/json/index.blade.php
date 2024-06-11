<!DOCTYPE html>
<html>
<head>
    <title>JSON Data Display</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #F1F8E8;
            padding: 20px;
        }
        .container {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
        }
        .card {
            width: calc(50% - 20px); /* Half of the container width with 20px margin */
            margin-bottom: 20px;
            border: 1px solid #95D2B3;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            background-color: #D8EFD3;
        }
        .card-header {
            background-color: #95D2B3;
            padding: 10px;
            border-radius: 8px 8px 0 0;
        }
        .card-body {
            padding: 10px;
        }
        .card-button {
            background-color: #95D2B3;
            border: none;
            padding: 10px;
            border-radius: 0 0 8px 8px;
            cursor: pointer;
            width: 100%;
            box-sizing: border-box;
            text-align: center;
            text-decoration: none;
            display: block;
        }
        .search-form {
            margin-bottom: 20px;
        }
        .search-input {
            padding: 10px;
            border-radius: 4px;
            border: 1px solid #CCCCCC;
            font-size: 16px;
            width: 200px;
            box-sizing: border-box;
        }
        .search-button {
            padding: 10px;
            background-color: #95D2B3;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }
        .pagination {
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .pagination a {
            padding: 10px;
            margin: 0px;
            background-color: #95D2B3;
            text-decoration: none;
            border-radius: 4px;
            cursor: pointer;
        }
        
    </style>
</head>
<body>
    <h1>JSON Data Display</h1>
    
    <form class="search-form" method="GET" action="{{ url('/json') }}">
        <input class="search-input" type="text" name="search" value="{{ request()->input('search') }}" placeholder="Search...">
        <button class="search-button" type="submit">Search</button>
    </form>
    
    <div class="container">
        @foreach ($data as $item)
            <div class="card">
                <div class="card-header">{{ $item['title'] }}</div>
                <div class="card-body">
                    <p>{{ $item['description'] }}</p>
                    <a href="{{ $item['link'] }}" class="card-button" target="_blank">Read More</a>
                </div>
            </div>
        @endforeach
    </div>
    
    <div class="pagination">
        {{ $data->links() }}
    </div>
</body>
</html>
