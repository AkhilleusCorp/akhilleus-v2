import React from "react";
import {FormControl, InputLabel, SelectChangeEvent} from "@mui/material";
import SelectInput from "app/common/components/input/SelectInput.tsx";
import IndexedArray from "app/common/utils/interfaces/IndexedArray.tsx";

type DurationSelectInputType = {
    label: string;
    name: string;
    value: any;
    required: boolean;
    onSelectChange: (event: SelectChangeEvent) => void;
}

const DurationSelectInput: React.FC<DurationSelectInputType> = ({ label, name, value, required, onSelectChange }) => {
    const restDurations: IndexedArray = {
        null: 'No rest',
        30: '30sec',
        60: '1min',
        90: '1min30',
        120: '2min',
        150: '2min30',
        180: '3min',
        210: '3min30',
        240: '4min',
        270: '4min30',
        300: '5min',
    };

    return (
        <FormControl fullWidth size="small">
            <InputLabel id={name}>{label}</InputLabel>
            <SelectInput label={label} name={name} value={value}
                         options={restDurations} required={required} onSelectChange={onSelectChange}/>
        </FormControl>
    )
}

export default DurationSelectInput;