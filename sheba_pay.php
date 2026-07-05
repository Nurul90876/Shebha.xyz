<?php include("header.php"); ?>

<style>
    .payment-container { 
        max-width: 650px; 
        margin: 40px auto; 
        background: white; 
        padding: 35px; 
        border-radius: 20px; 
        box-shadow: 0 15px 45px rgba(0,0,0,0.1); 
    }
    .payment-grid { 
        display: grid; 
        grid-template-columns: 1fr 1fr; 
        gap: 15px; 
        margin-bottom: 25px; 
    }
    .payment-card { 
        border: 2px solid #eee; 
        padding: 15px; 
        border-radius: 12px; 
        cursor: pointer; 
        display: flex; 
        align-items: center; 
        transition: 0.3s; 
        background: #fff;
    }
    .payment-card:hover { border-color: #d6006f; background: #fff9fb; transform: translateY(-3px); }
    .payment-card img { height: 30px; width: auto; margin-right: 15px; object-fit: contain; }
    .payment-card span { font-weight: bold; font-size: 15px; color: #333; }

    .method-details { 
        display: none; 
        background: #fdfdfd; 
        padding: 25px; 
        border-radius: 15px; 
        border: 1px solid #eee; 
        margin-top: 20px;
        box-shadow: inset 0 2px 4px rgba(0,0,0,0.02);
    }
    .pay-input { width: 100%; padding: 12px; margin: 10px 0 20px 0; border: 1px solid #ddd; border-radius: 8px; box-sizing: border-box; font-size: 15px; }
    .confirm-btn { width: 100%; background: #d6006f; color: white; padding: 16px; border: none; border-radius: 8px; cursor: pointer; font-weight: bold; font-size: 18px; transition: 0.3s; }
    .confirm-btn:hover { background: #b5005e; box-shadow: 0 5px 15px rgba(214, 0, 111, 0.3); }
    label { font-weight: 600; color: #555; font-size: 14px; }
</style>

<div style="min-height: 90vh; background: #f0f2f5; padding: 40px 20px;">
    <div class="payment-container">
        <div style="text-align: center; margin-bottom: 35px;">
            <h2 style="color: #d6006f; margin: 0; font-size: 30px;">Sheba Pay 💳</h2>
            <p style="color: #777;">Secure Multi-Channel Payment Gateway</p>
        </div>

        <form action="process_payment.php" method="POST">
            <div class="payment-grid">
                <div class="payment-card" onclick="showMethod('bkash')">
                    <img src="https://logos-world.net/wp-content/uploads/2022/07/BKash-Logo.png"> <span>bKash</span>
                </div>
                <div class="payment-card" onclick="showMethod('nagad')">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/8/8e/Nagad_Logo.svg/1200px-Nagad_Logo.svg.png"> <span>Nagad</span>
                </div>
                <div class="payment-card" onclick="showMethod('rocket')">
                    <img src="https://i.ibb.co/S6XyYvC/Rocket-Logo.png" onerror="this.src='https://via.placeholder.com/50?text=Rocket'"> <span>Rocket</span>
                </div>
                <div class="payment-card" onclick="showMethod('upay')">
                    <img src="https://www.upaybd.com/images/upay-logo.png" onerror="this.src='https://via.placeholder.com/50?text=Upay'"> <span>Upay</span>
                </div>

                <div class="payment-card" onclick="showMethod('atm')">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/5/5e/Visa_Inc._logo.svg/2560px-Visa_Inc._logo.svg.png"> <span>ATM/Visa</span>
                </div>
                <div class="payment-card" onclick="showMethod('mastercard')">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/2/2a/Mastercard-logo.svg/1280px-Mastercard-logo.svg.png"> <span>Mastercard</span>
                </div>
                <div class="payment-card" onclick="showMethod('paypal')">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/b/b5/PayPal.svg/1200px-PayPal.svg.png"> <span>PayPal</span>
                </div>
                <div class="payment-card" onclick="showMethod('dbbl')">
                    <img src="https://i.ibb.co/Mh8yL7G/DBBL.png" onerror="this.src='https://via.placeholder.com/50?text=DBBL'"> <span>DBBL Bank</span>
                </div>
                <div class="payment-card" onclick="showMethod('islamibank')">
                    <img src="https://i.ibb.co/mXfX05f/IBBL.png" onerror="this.src='https://via.placeholder.com/50?text=IBBL'"> <span>Islami Bank</span>
                </div>
                <div class="payment-card" onclick="showMethod('citybank')">
                    <img src="https://i.ibb.co/Qv6Zz4Q/City-Bank.png" onerror="this.src='https://via.placeholder.com/50?text=City'"> <span>City Bank</span>
                </div>
            </div>

            <div id="common-fields" class="method-details">
                <h4 id="method-title" style="margin-top:0; color:#d6006f; border-bottom: 2px solid #fde8ef; padding-bottom: 10px;">Method Details</h4>
                
                <div id="mobile-inputs">
                    <label>Wallet Number (11 Digits)</label>
                    <input type="text" name="wallet_num" class="pay-input" placeholder="01XXXXXXXXX" maxlength="11">
                    
                    <label>Amount (BDT)</label>
                    <input type="number" name="amount" id="mobile_amount" class="pay-input" placeholder="Enter Amount" min="10">

                    <label>PIN</label>
                    <input type="password" name="pin" class="pay-input" placeholder="XXXX" maxlength="4">
                </div>

                <div id="card-inputs" style="display:none;">
                    <label>Card Number</label>
                    <input type="text" name="card_num" class="pay-input" placeholder="XXXX XXXX XXXX XXXX">
                    <label>Amount (BDT)</label>
                    <input type="number" name="amount_card" class="pay-input" placeholder="Enter Amount">
                    <div style="display:flex; gap:15px;">
                        <div style="flex:1;"><label>Expiry Date</label><input type="text" class="pay-input" placeholder="MM/YY"></div>
                        <div style="flex:1;"><label>CVV</label><input type="password" class="pay-input" placeholder="XXX"></div>
                    </div>
                </div>

                <div id="bank-inputs" style="display:none;">
                    <label>Bank Account Name</label>
                    <input type="text" name="acc_name" class="pay-input" placeholder="Full Name">
                    <label>Account Number</label>
                    <input type="text" name="acc_num" class="pay-input" placeholder="XXXXXX-XXXX-XXX">
                    <label>Amount (BDT)</label>
                    <input type="number" name="amount_bank" class="pay-input" placeholder="Enter Amount">
                </div>

                <input type="hidden" name="selected_method" id="selected_method">
                
                <button type="submit" name="confirm_pay" class="confirm-btn">Confirm Payment</button>
            </div>
        </form>
    </div>
</div>

<script>
    function showMethod(method) {
        document.getElementById('common-fields').style.display = 'block';
        document.getElementById('selected_method').value = method;
        document.getElementById('method-title').innerText = method.toUpperCase() + " PAYMENT";

        document.getElementById('mobile-inputs').style.display = 'none';
        document.getElementById('card-inputs').style.display = 'none';
        document.getElementById('bank-inputs').style.display = 'none';

        if(['bkash', 'nagad', 'rocket', 'upay'].includes(method)) {
            document.getElementById('mobile-inputs').style.display = 'block';
        } else if(['atm', 'mastercard', 'paypal'].includes(method)) {
            document.getElementById('card-inputs').style.display = 'block';
        } else {
            document.getElementById('bank-inputs').style.display = 'block';
        }
        
        document.getElementById('common-fields').scrollIntoView({ behavior: 'smooth' });
    }
</script>

<?php include("footer.php"); ?>