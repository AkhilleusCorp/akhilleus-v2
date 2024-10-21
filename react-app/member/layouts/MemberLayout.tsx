import React from 'react';

interface MemberLayoutType {
    children: React.ReactNode
}

const MemberLayout: React.FC<MemberLayoutType> = (props) => {
    return (
        <div>{props.children}</div>
    );
}

export default MemberLayout;