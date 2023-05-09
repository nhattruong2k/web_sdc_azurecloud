<script>
    // Giá trị số nguyên (chỉ dương):
    // /^\d*$/.test(value)
    // Các giá trị số nguyên (dương và lên đến một giới hạn cụ thể):
    // /^\d*$/.test(value) && (value === "" || parseInt(value) <= 500)
    // Các giá trị số nguyên (cả dương và âm):
    // /^-?\d*$/.test(value)
    // Các giá trị dấu phẩy động (cho phép cả . và , làm dấu tách thập phân):
    // /^-?\d*[.,]?\d*$/.test(value)
    // Giá trị tiền tệ (nghĩa là nhiều nhất hai chữ số thập phân):
    // /^-?\d*[.,]?\d{0,2}$/.test(value)
    // Chỉ A-Z (nghĩa là các chữ cái Latinh cơ bản):
    // /^[a-z]*$/i.test(value)
    // Chỉ các chữ cái Latinh (nghĩa là tiếng Anh và hầu hết các ngôn ngữ châu Âu, xem https://unicode-table.com để biết chi tiết về Unicode phạm vi ký tự):
    // /^[a-z\u00c0-\u024f]*$/i.test(value)
    // Giá trị thập lục phân :
    // /^[0-9a-f]*$/i.test(value)

    // setInputFilter(document.getElementById("myTextBox"), function(value) {
    //     return /^\d*\.?\d*$/.test(value);
    // });

    function setInputFilter(textbox, inputFilter) {
        ["input", "keydown", "keyup", "mousedown", "mouseup", "select", "contextmenu", "drop"].forEach(function(event) {
            textbox.addEventListener(event, function() {
                if (inputFilter(this.value)) {
                    this.oldValue = this.value;
                    this.oldSelectionStart = this.selectionStart;
                    this.oldSelectionEnd = this.selectionEnd;
                } else if (this.hasOwnProperty("oldValue")) {
                    this.value = this.oldValue;
                    this.setSelectionRange(this.oldSelectionStart, this.oldSelectionEnd);
                }
            });
        });
    }
</script>
