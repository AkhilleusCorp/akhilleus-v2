import React from "react";
import {Box, Chip, FormControl, InputLabel, MenuItem, OutlinedInput, Select, SelectChangeEvent} from "@mui/material";
import { Theme, useTheme } from '@mui/material/styles';
import IndexedArray from "../../utils/interfaces/IndexedArray.tsx";
import QueryIds from "../../utils/interfaces/QueryIds.tsx";

type MultiSelectInputType = {
    label: string;
    name: string;
    value: string[] | number[] | null;
    options: IndexedArray;
    required: boolean;
    onSelectChange: (event: SelectChangeEvent<QueryIds>) => void;
}

const MultiSelectInput: React.FC<MultiSelectInputType> = ({ label, name, value, options, required, onSelectChange }) => {
    const [inputValue, setInputValue] = React.useState<QueryIds>(value ?? []);

    const theme = useTheme();
    const ITEM_HEIGHT = 48;
    const ITEM_PADDING_TOP = 8;
    const MenuProps = {
        PaperProps: {
            style: {
                maxHeight: ITEM_HEIGHT * 4.5 + ITEM_PADDING_TOP,
                width: 250,
            },
        },
    };

    function getStyles(name: string, inputValue: readonly unknown[], theme: Theme) {
        return {
            fontWeight: inputValue.includes(name)
                ? theme.typography.fontWeightMedium
                : theme.typography.fontWeightRegular,
        };
    }


    const menuItems = [];
    for (const key in options) {
        menuItems.push(<MenuItem key={key} value={key} style={getStyles(name, inputValue, theme)}>{options[key]}</MenuItem>)
    }

    const handleChange = (event: SelectChangeEvent<typeof inputValue>) => {
        const {
            target: { value },
        } = event;
        setInputValue(
            typeof value === 'string' ? value.split(',') : value,
        );

        onSelectChange(event);
    };

    return (
        <FormControl fullWidth size="small">
            <InputLabel id="demo-multiple-chip-label">{label}</InputLabel>
            <Select
                labelId="demo-multiple-chip-label"
                id="demo-multiple-chip"
                multiple
                name={name}
                value={inputValue ?? ''}
                onChange={handleChange}
                input={<OutlinedInput id="select-multiple-chip" label="Chip" />}
                renderValue={(selected) => (
                    <Box sx={{ display: 'flex', flexWrap: 'wrap', gap: 0.5 }}>
                        {selected.map((value) => (
                            <Chip key={value} label={options[value]} />
                        ))}
                    </Box>
                )}
                MenuProps={MenuProps}
                required={required}
            >
                { menuItems }
            </Select>
        </FormControl>
    )
}

export default MultiSelectInput;