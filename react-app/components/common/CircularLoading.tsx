import * as React from 'react';
import CircularProgress from '@mui/material/CircularProgress';
import Box from '@mui/material/Box';

type CircularLoadingType = {
    loading: boolean;
}

const CircularLoading: React.FC<CircularLoadingType> = ({ loading }) => {
    return (
        <>
            { loading && (
                <Box sx={{ display: 'flex', justifyContent: 'center' }} className={'margin-bottom-s'}>
                    <CircularProgress />
                </Box>
            )}
        </>
    );
}

export default CircularLoading;