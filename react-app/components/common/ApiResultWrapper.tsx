import * as React from 'react';
import CircularLoading from './CircularLoading';
import GlobalError from '../error/GlobalError';

type ApiResultWrapperType = {
    loading: boolean;
    error: string | null;
    hasPreviousPayload: boolean;
    children: React.ReactNode;
}

const ApiResultWrapper: React.FC<ApiResultWrapperType> = (props) => {
    return (
        <>
            { !props.hasPreviousPayload && (
                <CircularLoading loading={props.loading}/>
            )}            

            <GlobalError error={props.error}/>

            { (!props.loading || props.hasPreviousPayload) && (
                props.children
            )}
        </>
    );
}

export default ApiResultWrapper;