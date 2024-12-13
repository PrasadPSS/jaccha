import { Link } from "@inertiajs/react";
import React from "react";

const Header = ({ auth }) => {
  return (
    <header>
      {/* First Navbar */}
      <nav className="navbar navbar-expand-lg first-navbar">
        <div className="container">
          <Link className="navbar-brand" href={route('home')}>
            <img className="logo" src="/assets/images/logo.png" alt="Logo" />
          </Link>
          <button
            className="navbar-toggler"
            type="button"
            data-bs-toggle="collapse"
            data-bs-target="#navbarNav"
            aria-controls="navbarNav"
            aria-expanded="false"
            aria-label="Toggle navigation"
          >
            <span className="navbar-toggler-icon"></span>
          </button>
          <div className="search">
            <span className="input-group-text bg-transparent border-end-0">
              <i className="far fa-search"></i>
            </span>
            <input
              type="text"
              className="form-control border-start-0"
              placeholder="Search for an item..."
            />
          </div>
          <div className="collapse navbar-collapse" id="navbarNav">
            <ul className="navbar-nav ms-auto gap-4">
              <li className="nav-item">
                <Link className={route().current('product.index') ? "nav-link active" : "nav-link"} aria-current="page" href={route('product.index')}>Shop</Link>
              </li>
              <li className="nav-item">
                {auth && auth.user && (
                  <Link className={route().current('profile.edit') ? "nav-link active" : "nav-link"} href={route('profile.edit')}> Account</Link>
                  )}

                {!auth.user && 
                <Link className={route().current('login') ? "nav-link active" : "nav-link"} href={route('login')}> Log in</Link>
                }

              </li>
              <li className="nav-item">
                <Link className={route().current('wishlist.index') ? "nav-link active" : "nav-link"} href={route('wishlist.index')}>Wish List ({auth.wishlist_count})</Link>
              </li>
              <li className="nav-item">
                <Link className={route().current('cart.index') ? "nav-link active" : "nav-link"} href={route('cart.index')}>Basket<i className="far fa-shopping-basket"></i> ({auth.cart_count})</Link>
              </li>
            </ul>
          </div>
        </div>
      </nav>

      {/* Second Navbar */}
      <nav className="navbar navbar-expand-lg second-navbar">
        <div className="container">
          <button
            className="navbar-toggler"
            type="button"
            data-bs-toggle="collapse"
            data-bs-target="#navbarNav"
            aria-controls="navbarNav"
            aria-expanded="false"
            aria-label="Toggle navigation"
          >
            <span className="navbar-toggler-icon"></span>
          </button>
          <div
            className="collapse navbar-collapse justify-content-center"
            id="navbarNav"
          >
            <ul className="navbar-nav">
              <li className="nav-item">
                <a className="nav-link" aria-current="page" href="index.html">
                  New Arrivals<span># Fresh</span>
                </a>
              </li>
              <li className="nav-item">
                <a className="nav-link" href="about-us.html">
                  Vitamins & Supplements
                </a>
              </li>
              <li className="nav-item">
                <a className="nav-link" href="services.html">
                  Healthy Snacks
                </a>
              </li>
              <li className="nav-item">
                <a className="nav-link" href="contact.html">
                  Organic
                </a>
              </li>
              <li className="nav-item">
                <a className="nav-link" href="contact.html">
                  Gluten-Free
                </a>
              </li>
              <li className="nav-item">
                <a className="nav-link" href="contact.html">
                  Vegan
                </a>
              </li>
              <li className="nav-item">
                <a className="nav-link" href="contact.html">
                  Smoothies
                </a>
              </li>
              <li className="nav-item">
                <a className="nav-link" href="contact.html">
                  Subscription Boxes
                </a>
              </li>
              <li className="nav-item">
                <a className="nav-link" href="contact.html">
                  Energy-Boosting Foods
                </a>
              </li>
            </ul>
          </div>
        </div>
      </nav>
    </header>
  );
};

export default Header;
