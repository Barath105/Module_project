<?php
// Include your PHP functions or configurations here, if needed
// For example, include the file containing the generateProductId() function
// include_once 'your_functions_file.php';
?>
<html><head><meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
        
    
    <link rel="stylesheet" type="text/css" href="./i47_files/s47.css">
</head>
<body>
    <style>
        header {
            background-color: rgba(0, 0, 0, 0.7);
            color: #fff;
            padding: 20px 0;
          }
          
          nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0 20px;
          }
          
          nav .logo {
            font-size: 24px;
            font-weight: bold;
            display: flex;
            align-items: center;
          }
          
          nav ul {
            list-style: none;
            display: flex;
          }
          
          nav ul li {
            margin-right: 20px;
          }
          
          nav ul li a {
            text-decoration: none;
            color: #fff;
            transition: color 0.3s;
          }
          
          nav ul li a:hover {
            color: #f7ce68;
          }
          @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
          }
          .apply-form {
            animation: fadeIn 1s ease;
          }
        body {
            overflow-x: hidden; /* Hide vertical scrollbar */
          }
          info-message {
            font-size: 12px;
        }
    
        .info-message {
            font-size: 12px;
        }
    
        textarea:hover + .info-message {
            display: block;
        }
    
        .tag-container {
            position: relative;
            width: 322px;
            left: 30px;
            max-height: 50px; /* Set your desired max height 100px */
            overflow-y: auto; /* Add overflow-y property for vertical scrolling */
            border: 1px solid #ccc; /* Optional: Add border for better visibility */
            padding: 5px; /* Optional: Add padding for better spacing */
            background-color:#faf0f0;
            border-radius:30px;
        }
        
        .tag {
            background-color: #f2f2f2;
            border-radius: 4px;
            color: #333;
            display: inline-block;
            font-size: 12px;
            margin-bottom: 6px;
            margin-right: 6px;
            padding: 6px 10px;
        }
        
        .tag .tag-close {
            cursor: pointer;
            display: inline-block;
            font-weight: bold;
            margin-left: 6px;
        }
        
        #tag-input {
            border: none;
            font-size: 12px;
            margin-top: 6px;
            outline: none;
            width: 150px;
        }

        .employee-item {
            display: inline-block;
            background-color: #ddd;
            padding: 5px;
            margin-right: 5px;
            border-radius: 5px;
        }

        .employee-item .cancel-icon {
            margin-left: 5px;
            cursor: pointer;
            color: red;
        }

    </style>


    <div class="container" style="position: relative; top: 20px;">
        <header style="position: relative;top: -40px;width:1400px;left: -285px;height: 28px">
            <nav style="position: relative;width: 1200px">
                <div class="logo" style="position: relative;top: -9px;left: 8px">
                    <i class="fas fa-home"></i> Product Management</div>
                <ul>
                    <li><a href="http://localhost/PROJECT/36%20hr%20home/i36.php" style="position: relative;left: 136px;top:-9px">Home</a></li>
                </ul>
            </nav>
        </header>

        <div id="successMsg" class="success-msg" style="display: none;"></div>
        <div id="errorMsg" class="error-msg" style="display: none;"></div>

        <!-- Apply form within a single frame -->
        <form id="leaveForm" class="apply-form" method="POST" action="addproduct.php" enctype="multipart/form-data" style="position: relative;top: 100px;height: 828px;" onsubmit="submitForm(event)">
            <div class="form-group">
                <label for="name" style="position: relative;left: -12px;">Product Name</label>
                <input type="text" name="name" id="name" required="" fdprocessedid="69jjd">
            </div>

            <div class="form-group">
                <label for="productid" style="position: relative;left: -40px;">Product ID</label>
                <input type="text" name="productid" id="productid" value="<?php echo generateProductId(); ?>" readonly required fdprocessedid="dhnnrk">
            </div>
            

            <div class="form-group">
                <label for="clientname" style="position: relative;left: -28px;">Client Name</label>
                <input type="text" name="clientname" id="clientname" required="" fdprocessedid="dhnnrk">
            </div>

            <div class="form-group">
                <label for="clientcontact" style="position: relative;left: -12px;">Client Contact</label>
                <input type="text" name="clientcontact" id="clientcontact" required="" fdprocessedid="dhnnrk">
            </div>

            <div class="form-group">
                <label for="cost" style="position: relative;left: -43px;">Total Cost</label>
                <input type="text" name="cost" id="cost" required="" fdprocessedid="dhnnrk" oninput="calculateRemainingAmount()">
            </div>
        
            <div class="form-group">
                <label for="advpaid" style="position: relative;left: -15px;">Advance Paid</label>
                <input type="text" name="advpaid" id="advpaid" required="" fdprocessedid="dhnnrk" oninput="calculateRemainingAmount()">
            </div>
        
            <div class="form-group">
                <label for="remamount" style="position: relative;left: -40px;top:11px;">Remaining<br> Amount</label>
                <input type="text" name="remamount" id="remamount" required="" fdprocessedid="dhnnrk" readonly>
            </div>
            <div class="form-group">
                <label for="advreceipt" style="position: relative;left: 9px;top:9px;">Advance Receipt</label>
                <input type="file" name="advreceipt" id="advreceipt" accept=".pdf" required="" fdprocessedid="dhnnrk" style="position:relative;left:174px;top:-12px;width:232px;">
  

            </div>
            
            <h4 style="position:relative;left:29px;">Add Employee's:</h4>

            <div class="tag-container" style="position:relative;width:332px;left:30px;">
                    <span class="tag-text"></span>
                <input type="text" id="tag-input" placeholder="Add Employee's" style="position:relative;top:-16px;">
            </div>

            <h4 style="position: relative;width: 100px;left: 29px;">Time Period:</h4>

            <div class="form-group">
                <label for="startDate" style="position: relative;left: -12px;">Start Date</label>
                <input type="date" name="startDate" id="startDate" required="" style="width: 140px;background-color: #faf0f0;border: none;">
            </div>

            <div class="form-group">
                <label for="endDate" style="position: relative;left: -17px;">End Date</label>
                <input type="date" name="endDate" id="endDate" required="" style="width: 140px;background-color: #faf0f0;border: none;">
            </div>

            <button type="submit" style="position: relative;left: 135px;width: 134px;top: -8px;" fdprocessedid="jr2y1u">Add</button>
        </form>

        <!-- Button group below the form -->
        <div class="button-group" style="position: relative;top:-872px;">
            <button id="addBtn" style="width: 106px; box-shadow: rgba(0, 0, 0, 0.2) 0px 0px 10px;" fdprocessedid="edr5qqp">Add</button>

            <a href="../48 hr product pending/i48.php">
                <button id="pendingBtn" style="width: 106px;" fdprocessedid="3ngugx">Pending</button>
            </a>

            <a href="">
                <button id="historyBtn" style="width: 106px;" fdprocessedid="7nfh6h">History</button>
            </a>
        </div>
    </div>

    <script>
        function submitForm(event) {
            event.preventDefault();
            calculateRemainingAmount();
        
            var titleInput = document.getElementById("name");
            var productIdInput = document.getElementById("productid");
            var clientNameInput = document.getElementById("clientname");
            var clientContactInput = document.getElementById("clientcontact");
            var costInput = document.getElementById("cost");
            var advpaidInput = document.getElementById("advpaid"); // Add this line
            var remamountInput = document.getElementById("remamount"); // Add this line
            var startDateInput = document.getElementById("startDate");
            var endDateInput = document.getElementById("endDate");
        
            var title = titleInput.value;
            var productId = productIdInput.value;
            var clientName = clientNameInput.value;
            var clientContact = clientContactInput.value;
            var cost = costInput.value;
            var advpaid = advpaidInput.value; // Add this line
            var remamount = remamountInput.value; // Add this line
            var startDate = startDateInput.value;
            var endDate = endDateInput.value;
        
            // Get tags from the tag container
            var tagsContainer = document.querySelector(".tag-container");
            var tags = Array.from(tagsContainer.querySelectorAll(".tag-text")).map(tag => tag.textContent);
        
            // Check if there's at least one tag
            if (tags.length === 0) {
                showErrorMsg("Please add at least one employee tag.");
                return; // Stop form submission if validation fails
            }
        
            // Create a form element
            var form = document.createElement("form");
            form.method = "POST";
            form.action = "addproduct.php";
        
            // Create form fields and append them to the form
            function createHiddenField(name, value) {
                var hiddenField = document.createElement("input");
                hiddenField.type = "hidden";
                hiddenField.name = name;
                hiddenField.value = value;
                form.appendChild(hiddenField);
            }
        
            createHiddenField("name", title);
            createHiddenField("productid", productId);
            createHiddenField("clientname", clientName);
            createHiddenField("clientcontact", clientContact);
            createHiddenField("cost", cost);
            createHiddenField("advpaid", advpaid); // Add this line
            createHiddenField("remamount", remamount); // Add this line
            createHiddenField("tags", tags.join(","));
            createHiddenField("startDate", startDate);
            createHiddenField("endDate", endDate);
        
            // Append the form to the body and submit it
            document.body.appendChild(form);
            form.submit();
        }
        
        
        const tagInput = document.getElementById("tag-input");
        const tagContainer = document.querySelector(".tag-container");

        tagInput.addEventListener("keydown", function (event) {
            if (event.key === "Enter" || event.key === ",") {
                event.preventDefault();
                const tagText = this.value.trim();
                if (tagText !== "") {
                    const tagElement = document.createElement("div");
                    tagElement.classList.add("tag");

                    const tagTextElement = document.createElement("span");
                    tagTextElement.classList.add("tag-text");
                    tagTextElement.textContent = tagText;

                    const tagCloseElement = document.createElement("span");
                    tagCloseElement.classList.add("tag-close");
                    tagCloseElement.textContent = "x";

                    tagCloseElement.addEventListener("click", function () {
                        tagElement.remove();
                    });

                    tagElement.appendChild(tagTextElement);
                    tagElement.appendChild(tagCloseElement);

                    tagContainer.appendChild(tagElement);

                    this.value = "";
                }
            }
        });

        document.addEventListener("click", function (event) {
            if (event.target.classList.contains("tag-close")) {
                event.target.parentNode.remove();
            }
        });







        function showSuccessMsg(message) {
            var successMsg = document.getElementById("successMsg");
            successMsg.style.display = "block";
            successMsg.textContent = message;

            var errorMsg = document.getElementById("errorMsg");
            errorMsg.style.display = "none";

            // Alert message for success
            alert(message);
        }

        function showErrorMsg(message) {
            var successMsg = document.getElementById("successMsg");
            successMsg.style.display = "none";

            var errorMsg = document.getElementById("errorMsg");
            errorMsg.style.display = "block";
            errorMsg.textContent = message;

            // Alert message for error
            alert(message);
        }

        // JavaScript to handle button clicks
        document.getElementById("addBtn").addEventListener("click", function () {
            updateButtonColors(this);
            // Your other actions for the "Add" button here
        });

        document.getElementById("pendingBtn").addEventListener("click", function () {
            updateButtonColors(this);
            // Your other actions for the "Pending" button here
        });

        document.getElementById("historyBtn").addEventListener("click", function () {
            updateButtonColors(this);
            // Your other actions for the "History" button here
        });

        window.addEventListener("load", function () {
            var addBtn = document.getElementById("addBtn");
            addBtn.style.backgroundColor = "skyblue";
        });

            function updateButtonColors(clickedButton) {
            const buttons = document.querySelectorAll(".button-group button");

            buttons.forEach(function (button) {
                if (button === clickedButton) {
                    button.style.backgroundColor = "skyblue"; // Change the background color of the clicked button to skyblue
                } else {
                    button.style.backgroundColor = ""; // Reset the background color of other buttons to default
                }
            });
        }

        function calculateRemainingAmount() {
            // Get the values of Total Cost and Advance Paid
            var totalCost = parseFloat(document.getElementById('cost').value) || 0;
            var advancePaid = parseFloat(document.getElementById('advpaid').value) || 0;

            // Calculate the Remaining Amount
            var remainingAmount = totalCost - advancePaid;

            // Update the Remaining Amount field
            document.getElementById('remamount').value = remainingAmount.toFixed(2);
        }
    </script>
</body>
</html>
