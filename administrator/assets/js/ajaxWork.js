function showServices() {
  $.ajax({
    url: "./adminView/viewAllServices.php",
    method: "post",
    data: { record: 1 },
    success: function (data) {
      $(".allContent-section").html(data);
    },
  });
}

//add services data
function addServices() {
  var s_name = $("#s_name").val();
  var s_desc = $("#s_desc").val();
  var upload = $("#upload").val();
  var file = $("#file")[0].files[0];

  var fd = new FormData();
  fd.append("s_name", s_name);
  fd.append("s_desc", s_desc);
  fd.append("upload", upload);
  fd.append("file", file);

  $.ajax({
    url: "./controller/addServicesController.php",
    method: "post",
    data: fd,
    processData: false,
    contentType: false,
    success: function (data) {
      Swal.fire({
        title: "Added services successfully",
        icon: "success",
        confirmButtonColor: "#3085d6",
        confirmButtonText: "Ok",
      }).then((result) => {
        if (result.isConfirmed) {
          window.location.href = "../administrator/index.php?#services";
          $("form").trigger("reset");
          showServices();
        }
      });
    },
  });
}

//edit services data
function servicesEditForm(id) {
  $.ajax({
    url: "./adminView/editServicesForm.php",
    method: "post",
    data: { record: id },
    success: function (data) {
      $(".allContent-section").html(data);
    },
  });
}

//update services after submit
function updateServices() {
  var services_id = $("#services_id").val();
  var s_name = $("#s_name").val();
  var s_desc = $("#s_desc").val();
  var status = $("#status").val();
  var existingImage = $("#existingImage").val();
  var newImage = $("#newImage")[0].files[0];
  var fd = new FormData();
  fd.append("services_id", services_id);
  fd.append("s_name", s_name);
  fd.append("s_desc", s_desc);
  fd.append("status", status);
  fd.append("existingImage", existingImage);
  fd.append("newImage", newImage);

  $.ajax({
    url: "./controller/updateServicesController.php",
    method: "post",
    data: fd,
    processData: false,
    contentType: false,
    success: function (data) {
      Swal.fire({
        title: "Data Update Successfully",
        icon: "success",
        confirmButtonColor: "#3085d6",
        confirmButtonText: "OK",
      }).then((result) => {
        if (result.isConfirmed) {
          $("form").trigger("reset");
          showServices();
        }
      });
    },
  });
}

function showInquiries() {
  $.ajax({
    url: "./adminView/viewInquiries.php",
    method: "post",
    data: { record: 1 },
    success: function (data) {
      $(".allContent-section").html(data);
    },
  });
}

function ChangeStatus(id) {
  $.ajax({
    url: "./controller/updateInquiry.php",
    method: "post",
    data: { record: id },
    success: function (data) {
      alert("Inquiry Status updated successfully");
      $("form").trigger("reset");
      showInquiries();
    },
  });
}

function showCustomers() {
  $.ajax({
    url: "./adminView/viewCustomers.php",
    method: "post",
    data: { record: 1 },
    success: function (data) {
      $(".allContent-section").html(data);
    },
  });
}

//admin

function showAdmin() {
  $.ajax({
    url: "./adminView/viewAdmin.php",
    method: "post",
    data: { record: 1 },
    success: function (data) {
      $(".allContent-section").html(data);
    },
  });
}

//add admin
function addAdmin() {
  var a_name = $("#a_name").val();
  var a_email = $("#a_email").val();
  var a_number = $("#a_number").val();
  var a_type = $("#user_type").val();
  var a_pass = $("#a_pass").val();
  var a_cpass = $("#a_cpass").val();

  var fd = new FormData();
  fd.append("name", a_name);
  fd.append("email", a_email);
  fd.append("number", a_number);
  fd.append("user_type", a_type);
  fd.append("password", a_pass);
  fd.append("c_password", a_cpass);

  $.ajax({
    url: "./controller/addAdmin.php",
    method: "POST",
    data: fd,
    processData: false,
    contentType: false,
    success: function (response) {
      if (response === "success") {
        alert("Added admin successfully.");
        window.location.href = '../administrator/index.php#admin';
        $("form").trigger("reset");
        showAdmin();
      } else {
        alert("Failed to add admin. Please try again.");
      }
    },
    error: function (xhr, status, error) {
      console.log(xhr.responseText);
    }
  });
}


//edit admin
function editAdmin(id) {
  $.ajax({
    url: "./adminView/editAdmin.php",
    method: "post",
    data: { record: id },
    success: function (data) {
      $(".allContent-section").html(data);
    },
  });
}

//update admin after submit
function updateAdmin() {
  var admin_id = $("#admin_id").val();
  var a_name = $("#a_name").val();
  var a_email = $("#a_email").val();
  var a_number = $("#a_number").val();
  var fd = new FormData();
  fd.append("admin_id", admin_id);
  fd.append("name", a_name);
  fd.append("email", a_email);
  fd.append("number", a_number);

  $.ajax({
    url: "./controller/updateAdmin.php",
    method: "post",
    data: fd,
    processData: false,
    contentType: false,
    
    success: function (data) {
      Swal.fire({
        title: "Update Admin",
        icon: "success",
        confirmButtonColor: "#3085d6",
        confirmButtonText: "OK",
      }).then((result) => {
        if (result.isConfirmed) {
          $("form").trigger("reset");
          showAdmin();
        }
      });
    },
  });
}

//category

function showCategory() {
  $.ajax({
    url: "./adminView/viewCategories.php",
    method: "post",
    data: { record: 1 },
    success: function (data) {
      $(".allContent-section").html(data);
    },
  });
}

//edit category data
function catEditForm(id) {
  $.ajax({
    url: "./adminView/editCatForm.php",
    method: "post",
    data: { record: id },
    success: function (data) {
      $(".allContent-section").html(data);
    },
  });
}

//update category after submit
function updateCat() {
  var category_id = $("#category_id").val();
  var c_name = $("#c_name").val();
  var fd = new FormData();
  fd.append("category_id", category_id);
  fd.append("c_name", c_name);

  $.ajax({
    url: "./controller/CatUpdateController.php",
    method: "post",
    data: fd,
    processData: false,
    contentType: false,
    success: function (data) {
      Swal.fire({
        title: "Update Category",
        icon: "success",
        confirmButtonColor: "#3085d6",
        confirmButtonText: "OK",
      }).then((result) => {
        if (result.isConfirmed) {
          $("form").trigger("reset");
          showCategory();
        }
      });
    },
  });
}

function showProductItems() {
  $.ajax({
    url: "./adminView/viewAllProducts.php",
    method: "post",
    data: { record: 1 },
    success: function (data) {
      $(".allContent-section").html(data);
    },
  });
}

//add product data
function addItems(){
  var p_name=$('#p_name').val();
  var p_desc=$('#p_desc').val();
  var stocks=$('#stocks').val();
  var p_price=$('#p_price').val();
  var category=$('#category').val();
  var upload=$('#upload').val();
  var file=$('#file')[0].files[0];

  var fd = new FormData();
  fd.append('p_name', p_name);
  fd.append('p_desc', p_desc);
  fd.append('stocks', stocks);
  fd.append('p_price', p_price);
  fd.append('category', category);
  fd.append('file', file);
  fd.append('upload', upload);
  $.ajax({
      url:"./controller/addItemController.php",
      method:"post",
      data:fd,
      processData: false,
      contentType: false,
      success: function (data) {
        Swal.fire({
          title: "Product Added Successfully",
          icon: "success",
          confirmButtonColor: "#3085d6",
          confirmButtonText: "OK",
        }).then((result) => {
          if (result.isConfirmed) {
            header("Location: ../administrator/index.php?#products");
            $("form").trigger("reset");
            showProductItems();
          }
        });
      },
    });
  }

//edit product data
function itemEditForm(id) {
  $.ajax({
    url: "./adminView/editItemForm.php",
    method: "post",
    data: { record: id },
    success: function (data) {
      $(".allContent-section").html(data);
    },
  });
}

//update product after submit
function updateItems() {
  var product_id = $("#product_id").val();
  var p_name = $("#p_name").val();
  var p_desc = $("#p_desc").val();
  var category = $("#category").val();
  var existingImage = $("#existingImage").val();
  var newImage = $("#newImage")[0].files[0];
  var fd = new FormData();
  fd.append("product_id", product_id);
  fd.append("p_name", p_name);
  fd.append("p_desc", p_desc);
  fd.append("category", category);
  fd.append("existingImage", existingImage);
  fd.append("newImage", newImage);

  $.ajax({
    url: "./controller/updateItemController.php",
    method: "post",
    data: fd,
    processData: false,
    contentType: false,
    success: function (data) {
      Swal.fire({
        title: "Data Update Successfully",
        icon: "success",
        confirmButtonColor: "#3085d6",
        confirmButtonText: "OK",
      }).then((result) => {
        if (result.isConfirmed) {
          $("form").trigger("reset");
          showProductItems();
        }
      });
    },
  });
}

//add shipping fees

function showShipping() {
  $.ajax({
    url: "./adminView/viewShipping.php",
    method: "post",
    data: { record: 1 },
    success: function (data) {
      $(".allContent-section").html(data);
    },
  });
}

function addShipping() {
  var barangay = $("#barangay").val();
  var municipality = $("#municipality").val();
  var shipping_cost = $("#shipping_cost").val();

  var fd = new FormData();
  fd.append("barangay", barangay);
  fd.append("municipality", municipality);
  fd.append("shipping_cost", shipping_cost);
  $.ajax({
    url: "./controller/addShipping.php",
    method: "post",
    data: fd,
    processData: false,
    contentType: false,
    success: function (data) {
      Swal.fire({
        title: "Added Shipping successfully",
        icon: "success",
        confirmButtonColor: "#3085d6",
        confirmButtonText: "OK",
      }).then((result) => {
        if (result.isConfirmed) {
      header("Location: ../administrator/index.php?#shipping");
      $("form").trigger("reset");
      showShipping();
    }
  });
},
  });
}

//edit shipping data
function editShipping(id) {
  $.ajax({
    url: "./adminView/editShipping.php",
    method: "post",
    data: { record: id },
    success: function (data) {
      $(".allContent-section").html(data);
    },
  });
}

//update shipping after submit
function updateShipping() {
  var shipping_id = $("#shipping_id").val();
  var municipality = $("#municipality").val();
  var barangay = $("#barangay").val();
  var shipping_cost = $("#shipping_cost").val();
  var fd = new FormData();
  fd.append("shipping_id", shipping_id);
  fd.append("barangay", barangay);
  fd.append("municipality", municipality);
  fd.append("shipping_cost", shipping_cost);

  $.ajax({
    url: "./controller/updateShipping.php",
    method: "post",
    data: fd,
    processData: false,
    contentType: false,
    success: function (data) {
      Swal.fire({
        title: "Successfully",
        text: "Update Shipping!",
        icon: "success",
        showConfirmButton: false,
        timer: 2000,
     }).then((result) => {
        if (result) {
          $("form").trigger("reset");
          showShipping();
        }
      });
    },
  });
}

function showOrders() {
  $.ajax({
    url: "./adminView/viewEachOrder.php",
    method: "post",
    data: { record: 1 },
    success: function (data) {
      $(".allContent-section").html(data);
    },
  });
}

function ChangeOrderStatus(id) {
  $.ajax({
    url: "./controller/updateOrderStatus.php",
    method: "post",
    data: { record: id },
    success: function (data) {
      alert("Order Status updated successfully");
      $("form").trigger("reset");
      showOrders();
    },
  });
}

function showSale() {
  $.ajax({
    url: "./adminView/viewSales.php",
    method: "post",
    data: { record: 1 },
    success: function (data) {
      $(".allContent-section").html(data);
    },
  });
}

function showInvent() {
  $.ajax({
    url: "./adminView/viewInventory.php",
    method: "post",
    data: { record: 1 },
    success: function (data) {
      $(".allContent-section").html(data);
    },
  });
}

function showWishlist() {
  $.ajax({
    url: "./adminView/viewWishlist.php",
    method: "post",
    data: { record: 1 },
    success: function (data) {
      $(".allContent-section").html(data);
    },
  });
}

function showTransaction() {
  $.ajax({
    url: "./adminView/viewTransaction.php",
    method: "post",
    data: { record: 1 },
    success: function (data) {
      $(".allContent-section").html(data);
    },
  });
}


//edit transaction data
function editTransaction(id) {
  $.ajax({
    url: "./adminView/editTransaction.php",
    method: "post",
    data: { record: id },
    success: function (data) {
      $(".allContent-section").html(data);
    },
  });
}

//update transaction after submit
function updateTransaction() {
  var transaction_id = $("#transaction_id").val();
  var stocks = $("#stocks").val();
  var price = $("#price").val();
  var date = $("#date").val();
  var fd = new FormData();
  fd.append("transaction_id", transaction_id);
  fd.append("stocks", stocks);
  fd.append("price", price);
  fd.append("date", date);
  $.ajax({
    url: "./controller/updateTransaction.php",
    method: "post",
    data: fd,
    processData: false,
    contentType: false,
    success: function (data) {
      Swal.fire({
        title: "Update Transaction",
        icon: "success",
        confirmButtonColor: "#3085d6",
        confirmButtonText: "OK",
      }).then((result) => {
        if (result.isConfirmed) {
          $("form").trigger("reset");
          showTransaction();
        }
      });
    },
  });
}
