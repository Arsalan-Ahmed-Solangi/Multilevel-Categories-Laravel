<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">BLOG WITH MULTILEVEL CATEGORIES</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
        <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="{{ route('categories.create') }}"><i class="fa fa-tasks"></i> Add Category</a>
        </li>
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="#"><i class="fa fa-eye"></i> Categories</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="#"><i class="fa fa-plus-circle"></i> Add Multi Category</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#"><i class="fa fa-eye"></i> SubCategories</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
