import React from "react";

type TableType = {
    children: React.ReactNode
}

const Table: React.FC<TableType> = (props) => {
    return (
        <table>
            {props.children}
        </table>
    )
}

export default Table;