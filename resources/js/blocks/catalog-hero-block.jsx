import { registerBlockType } from '@wordpress/blocks';
import { InspectorControls, useBlockProps } from '@wordpress/block-editor';
import { PanelBody, TextControl } from '@wordpress/components';
import { __ } from '@wordpress/i18n';
import ServerSideRender from '@wordpress/server-side-render';

registerBlockType('novicell/catalog-hero', {
  title: __('Cabecera del catálogo', 'sage'),
  description: __('Titular de la home con un índice real de materias con cursos.', 'sage'),
  category: 'novicell',
  icon: 'align-left',

  attributes: {
    eyebrow: {
      type: 'string',
      default: 'Catálogo de formación',
    },
    headline: {
      type: 'string',
      default: 'Cursos pensados para que aprendas lo que vas a usar.',
    },
  },

  edit: ({ attributes, setAttributes }) => {
    const { eyebrow, headline } = attributes;
    const blockProps = useBlockProps();

    return (
      <div {...blockProps}>
        <InspectorControls>
          <PanelBody title={__('Textos', 'sage')}>
            <TextControl
              label={__('Eyebrow', 'sage')}
              value={eyebrow}
              onChange={(value) => setAttributes({ eyebrow: value })}
            />
            <TextControl
              label={__('Titular', 'sage')}
              value={headline}
              onChange={(value) => setAttributes({ headline: value })}
            />
          </PanelBody>
        </InspectorControls>

        {/*
          El índice de materias no es un atributo editable: se calcula en
          PHP a partir de las materias (course_subject) que realmente
          tienen cursos publicados, así que ServerSideRender es la única
          forma de verlo en el editor sin duplicar esa consulta en JS.
        */}
        <ServerSideRender
          block="novicell/catalog-hero"
          attributes={attributes}
        />
      </div>
    );
  },

  save: () => null,
});
