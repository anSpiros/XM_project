import React from "react";
import "../scss/header.scss";
import { NavLink } from "react-router-dom";
import { FORM_ROUTE, RESULTS_ROUTE, ROOT_ROUTE } from "../routes/routes";

function Header() {
  return (
    <div className="container-fluid header">
      <div className="row">
        <div className="col-12">
          <ul className="list-unstyled header-list mb-0">
            <li>
              <NavLink exact to={ROOT_ROUTE} activeClassName="active">
                Home
              </NavLink>
            </li>
            <li>
              <NavLink exact to={FORM_ROUTE} activeClassName="active">
                Form
              </NavLink>
            </li>
            <li>
              <NavLink exact to={RESULTS_ROUTE} activeClassName="active">
                Results
              </NavLink>
            </li>
          </ul>
        </div>
      </div>
    </div>
  );
}

export default Header;
