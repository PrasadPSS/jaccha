import React from "react";


const ViewInvoice = () => {
  const { orderId } = new URLSearchParams();
 // Capture the order ID from the URL params

  const printInvoice = (selector) => {
    const data = document.querySelector(selector).innerHTML;
    const printWindow = window.open("", "Print Invoice", "height=600,width=800");
    printWindow.document.write('<html><head><title>Print Invoice</title>');
    printWindow.document.write(`
      <style>
        body {
          font-family: Arial !important;
          color: #000;
        }
        .table {
          width: 100%;
          max-width: 100%;
          background-color: transparent;
        }
        /* Add your other styles here */
      </style>
    `);
    printWindow.document.write('</head><body>');
    printWindow.document.write(data);
    printWindow.document.write('</body></html>');
    printWindow.document.close();
    printWindow.focus();
    printWindow.print();
    printWindow.close();
  };

  return (
    <div className="app-content content">
      <div className="content-overlay"></div>
      <div className="content-wrapper">
        <div className="content-header row">
          <div className="content-header-left col-12 mb-2 mt-1">
            <div className="row breadcrumbs-top">
              <div className="col-12">
                <h5 className="content-header-title float-left pr-1 mb-0">Orders Invoice</h5>
                <div className="breadcrumb-wrapper col-12">
                  <ol className="breadcrumb p-0 mb-0">
                    <li className="breadcrumb-item">
                      <a href="/admin/dashboard">
                        <i className="bx bx-home-alt"></i>
                      </a>
                    </li>
                    <li className="breadcrumb-item">
                      <a href="/admin/orders">Orders</a>
                    </li>
                    <li className="breadcrumb-item active">Order Invoice</li>
                  </ol>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div className="row">
          <div className="col-12">
            <div className="card">
              <div className="card-header">
                <a href="/admin/orders" className="btn btn-outline-secondary float-right ml-1">
                  <i className="bx bx-arrow-back"></i>
                  <span className="align-middle ml-25">Back</span>
                </a>
                <button
                  className="btn btn-outline-secondary float-right ml-1"
                  onClick={() => printInvoice(".printinvoice")}
                >
                  <span className="align-middle ml-25">Print</span>
                </button>
                <a
                  href={`/admin/orders/invoice/${orderId}`}
                  className="btn btn-outline-secondary float-right ml-1"
                >
                  <span className="align-middle ml-25">Download Invoice</span>
                </a>
                <h4 className="card-title">Order Invoice</h4>
              </div>

              <div className="card-content">
                <div className="card-body card-dashboard">
                  <div className="printinvoice">
                    <h3>Invoice Details</h3>
                    <p>Order ID: {orderId}</p>
                    <p>Customer Name: John Doe</p>
                    <p>Total: $200</p>
                    {/* Add other order details dynamically here */}
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  );
};

export default ViewInvoice;
