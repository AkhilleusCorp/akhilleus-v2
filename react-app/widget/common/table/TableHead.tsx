import React from "react";

type TableHeaderType = {
    headers: string[]
}

const TableHead: React.FC<TableHeaderType> = ({ headers }) => {
    return (
        <thead>
            <tr>
                { headers.map((header) => (
                    <th key={`th-${header}`}>{header}</th>
                ))}
            </tr>
        </thead>
    )
}

export default TableHead;