<?php

include('config/db.php');
$query = "SELECT * FROM `contacts` ORDER BY `id`";
$result = mysqli_query($conn, $query);
$contacts = mysqli_fetch_all($result, MYSQLI_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Phone Book</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
    integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
  <div class="container my-5 p-3">
    <div class="container bg-light d-flex justify-content-between py-3 px-5">
      <h3>Phonebook</h3>
      <button type="button" class="btn btn-primary px-4" data-bs-toggle="modal" data-bs-target="#addForm">
        Add +
      </button>
      <!-- Modal -->
      <div class="modal fade" id="addForm" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="exampleModalLabel">
                Create New Contact
              </h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <form action="add-check.php" method="post">
                <div class="mb-3">
                  <label for="name" class="form-label">Name</label>
                  <input type="text" class="form-control" id="name" placeholder="e.g., John Doe" name="name" />
                </div>
                <div class="mb-3">
                  <label for="phone" class="form-label">Phone No.</label>
                  <input type="number" class="form-control" id="phone" placeholder="e.g., 9876543210" name="phone" />
                </div>
                <div class="mb-3">
                  <label for="email" class="form-label">Email Address</label>
                  <input type="email" class="form-control" id="email" placeholder="name@example.com" name="email" />
                </div>
                <button type="submit" class="btn btn-success w-100" name="addContact">
                  Submit
                </button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>

    <?php if (mysqli_num_rows($result) > 0) { ?>
      <div class="mt-3 table-responsive px-3">
        <table class="table table-bordered table-striped align-middle border-dark">
          <thead class="text-center">
            <tr>
              <th scope="col">Sl. No.</th>
              <th scope="col">Name</th>
              <th scope="col">Phone</th>
              <th scope="col">Email</th>
              <th scope="col">Edit</th>
              <th scope="col">Delete</th>
            </tr>
          </thead>
          <tbody class="table-group-divider">
            <?php foreach ($contacts as $contact) { ?>
              <tr>
                <td class="text-center">
                  <?php echo $contact['id']; ?>
                </td>
                <td class="text-center">
                  <?php echo $contact['name']; ?>
                </td>
                <td class="text-center">
                  <?php echo $contact['phone']; ?>
                </td>
                <td class="text-center">
                  <?php echo $contact['email']; ?>
                </td>
                <td class="text-center">
                  <button type="button" class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#editForm<?php echo $contact['id']; ?>">
                    <i class="fa-solid fa-pen-to-square"></i>
                  </button>
                  <!-- Modal -->
                  <div class="modal fade" id="editForm<?php echo $contact['id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h1 class="modal-title fs-5" id="exampleModalLabel">
                            Edit Contact
                          </h1>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                          <form action="edit-check.php" method="POST">
                            <input type="hidden" name="id_to_edit" value="<?php echo $contact['id']; ?>">
                            <div class="mb-3">
                              <label for="name" class="form-label">Name</label>
                              <input type="text" class="form-control" id="name" placeholder="e.g., John Doe" name="name"
                                value="<?php echo $contact['name']; ?>" />
                            </div>
                            <div class="mb-3">
                              <label for="phone" class="form-label">Phone No.</label>
                              <input type="number" class="form-control" id="phone" placeholder="e.g., 9876543210"
                                name="phone" value="<?php echo $contact['phone']; ?>" />
                            </div>
                            <div class="mb-3">
                              <label for="email" class="form-label">Email Address</label>
                              <input type="email" class="form-control" id="email" placeholder="name@example.com"
                                name="email" value="<?php echo $contact['email']; ?>" />
                            </div>
                            <button type="submit" class="btn btn-success w-100" name="editContact">
                              Update
                            </button>
                          </form>
                        </div>
                      </div>
                    </div>
                  </div>
                </td>
                <td class="text-center">
                  <form action="delete-check.php" method="POST">
                    <input type="hidden" name="id_to_delete" value="<?php echo $contact['id']; ?>" />
                    <button type="submit" name="delete" class="btn btn-sm btn-danger">
                      <i class="fa-solid fa-trash"></i>
                    </button>
                  </form>
                </td>
              </tr>
            <?php } ?>
          </tbody>
        </table>
      </div>
    <?php } else { ?>
      <div class="container border mt-3 p-5">
        <h1 class="text-center">No contacts to show!</h1>
      </div>
    <?php } ?>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz"
    crossorigin="anonymous"></script>
</body>

</html>

