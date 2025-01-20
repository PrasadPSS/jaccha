import React from "react";

const CategoriesContent = ({ categoriescontent }) => {
    return (
        <div className="container">
            <div className="row">
                <div className="col-sm-3"></div>
                <div className="col-sm-9">
                    <div
                        dangerouslySetInnerHTML={{
                            __html: categoriescontent.contents,
                        }}
                        className="ml-4 pl-4"
                        style={{marginLeft:"17px"}}
                    ></div>
                </div>
            </div>
        </div>
    );
};

export default CategoriesContent;
