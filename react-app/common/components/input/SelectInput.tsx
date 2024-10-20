import React from "react";
import {FormControl, InputLabel, MenuItem, Select, SelectChangeEvent} from "@mui/material";
import IndexedArray from "app/common/utils/interfaces/IndexedArray.tsx";

type DropdownInputType = {
    label: string;
    name: string;
    value: any;
    options: IndexedArray;
    required: boolean;
    onSelectChange: (event: SelectChangeEvent) => void;
}

const SelectInput: React.FC<DropdownInputType> = ({ label, name, value, options, required, onSelectChange }) => {
    const [inputValue, setInputValue] = React.useState<any|null>(value);

    const menuItems = [];
    for (const key in options) {
        menuItems.push(<MenuItem key={key} value={key}>{options[key]}</MenuItem>)
    }

    const handleChange = (event: SelectChangeEvent) => {
        const selectedValue = event.target.value;
        setInputValue(selectedValue as string);

        onSelectChange(event);
    };

    return (
        <FormControl fullWidth size="small">
            <InputLabel id={name}>{label}</InputLabel>
            <Select
                labelId={name}
                value={inputValue ?? ''}
                name={name}
                label={label}
                onChange={handleChange}
                required={required}>
                { !required && (
                    <MenuItem value="">
                        <em>None</em>
                    </MenuItem>
                )}
                { menuItems }
            </Select>
        </FormControl>
    )
}

export default SelectInput;