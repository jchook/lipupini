import van from '/lib/van-1.2.1.min.js'

const { div, audio, source } = van.tags

const Audio = ({collection, baseUri, filename, data, fileType}) => {
	return div({class: 'audio'},
		audio({controls: 'true', preload: 'metadata', title: data.caption ?? filename, loading: 'lazy'},
			source({src: `${baseUri}file/${collection}/audio/${filename}`, type: fileType}),
		),
	)
}

export { Audio }
